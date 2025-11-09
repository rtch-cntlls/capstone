<?php

namespace App\Http\Controllers;

use App\Models\MessageAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MediaController extends Controller
{
    public function show(MessageAttachment $attachment, Request $request)
    {
        $disk = Storage::disk('public');
        $path = $attachment->attachment_path;
        if (!$disk->exists($path)) {
            abort(404);
        }
        $fullPath = $disk->path($path);
        $mime = $attachment->mime_type ?: $disk->mimeType($path) ?: 'application/octet-stream';

        $size = filesize($fullPath);
        $forceDownload = filter_var($request->query('download'), FILTER_VALIDATE_BOOL);
        $range = $request->headers->get('Range');

        if ($forceDownload) {
            $filename = basename($path);
            return response()->stream(function () use ($fullPath) {
                readfile($fullPath);
            }, 200, [
                'Content-Type' => $mime,
                'Content-Length' => (string)$size,
                'Content-Disposition' => 'attachment; filename="'.$filename.'"',
                'Cache-Control' => 'public, max-age=31536000',
            ]);
        }

        if ($range) {
            // Support HTTP Range for video/audio seeking
            [$unit, $range] = explode('=', $range, 2);
            if (strtolower($unit) !== 'bytes') {
                return response('', 416);
            }
            [$start, $end] = array_pad(array_map('intval', explode('-', $range, 2)), 2, null);
            if ($end === null || $end >= $size) { $end = $size - 1; }
            if ($start === null || $start < 0) { $start = 0; }
            $length = $end - $start + 1;

            $response = new StreamedResponse(function () use ($fullPath, $start, $length) {
                $fh = fopen($fullPath, 'rb');
                fseek($fh, $start);
                $bytesLeft = $length;
                while ($bytesLeft > 0 && !feof($fh)) {
                    $chunk = fread($fh, min(8192, $bytesLeft));
                    echo $chunk;
                    $bytesLeft -= strlen($chunk);
                    if (connection_aborted()) { break; }
                }
                fclose($fh);
            }, 206, [
                'Content-Type' => $mime,
                'Content-Length' => (string)$length,
                'Content-Range' => "bytes $start-$end/$size",
                'Accept-Ranges' => 'bytes',
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
            ]);

            return $response;
        }

        return response()->stream(function () use ($fullPath) {
            readfile($fullPath);
        }, 200, [
            'Content-Type' => $mime,
            'Content-Length' => (string)$size,
            'Accept-Ranges' => 'bytes',
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ]);
    }

    public function thumbnail(MessageAttachment $attachment)
    {
        if (!$attachment->thumbnail_path) {
            abort(404);
        }
        $disk = Storage::disk('public');
        $path = $attachment->thumbnail_path;
        if (!$disk->exists($path)) {
            abort(404);
        }
        $fullPath = $disk->path($path);
        $mime = $disk->mimeType($path) ?: 'image/jpeg';
        $size = filesize($fullPath);

        return response()->stream(function () use ($fullPath) {
            readfile($fullPath);
        }, 200, [
            'Content-Type' => $mime,
            'Content-Length' => (string)$size,
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ]);
    }
}
