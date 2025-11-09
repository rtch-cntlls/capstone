<?php

namespace App\Services\Shop;

use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ChatService
{
    public function getMessagesWithAdmin()
    {
        $adminId = User::where('role_id', 1)->value('user_id');

        $messages = Message::with('attachments')->where(function($q) use ($adminId){
            $q->where('sender_id', Auth::id())->where('receiver_id', $adminId);
        })->orWhere(function($q) use ($adminId){
            $q->where('sender_id', $adminId)->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        return ['messages'=>$messages, 'receiverId'=>$adminId];
    }

    public function sendMessage($receiverId, ?string $content, array $attachments = [])
    {
        $message = Message::create([
            'sender_id'=>Auth::id(),
            'receiver_id'=>$receiverId,
            'content'=>$content,
        ]);

        foreach ($attachments as $file) {
            if (!$file instanceof UploadedFile) continue;
            $storedPath = $file->store('messages', 'public');
            $mime = $file->getMimeType();
            $type = null;
            if ($mime && str_starts_with($mime, 'image/')) {
                $type = 'image';
            } elseif ($mime && str_starts_with($mime, 'video/')) {
                $type = 'video';
            } else {
                $type = 'other';
            }

            $thumbPath = null;
            if ($type === 'video') {
                $thumbPath = $this->generateVideoThumbnail($storedPath);
            }

            MessageAttachment::create([
                'message_id' => $message->message_id,
                'attachment_path' => $storedPath,
                'attachment_type' => $type,
                'mime_type' => $mime,
                'thumbnail_path' => $thumbPath,
            ]);
        }

        return $message->load('attachments');
    }

    private function generateVideoThumbnail(string $relativeStoredPath): ?string
    {
        try {
            $ffmpeg = trim((string) shell_exec('ffmpeg -version 2>NUL || echo'));
            if ($ffmpeg === '') {
                return null;
            }
            $source = Storage::disk('public')->path($relativeStoredPath);
            $thumbRel = 'messages/thumbnails/' . pathinfo($relativeStoredPath, PATHINFO_FILENAME) . '.jpg';
            $thumbAbs = Storage::disk('public')->path($thumbRel);
            if (!is_dir(dirname($thumbAbs))) {
                @mkdir(dirname($thumbAbs), 0775, true);
            }
            $srcArg = escapeshellarg($source);
            $dstArg = escapeshellarg($thumbAbs);
            @shell_exec("ffmpeg -y -ss 00:00:01 -i $srcArg -vframes 1 -vf scale='640:-1' $dstArg 2>NUL");
            return file_exists($thumbAbs) ? $thumbRel : null;
        } catch (\Throwable) {
            return null;
        }
    }
}

