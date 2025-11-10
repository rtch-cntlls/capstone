<?php

namespace App\Services\Admin;

use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class MessageService
{
    public function getMessagedCustomers()
    {
        $authUserId = Auth::id();

        $userIds = Message::where('sender_id', $authUserId)
            ->orWhere('receiver_id', $authUserId)
            ->pluck('sender_id')
            ->merge(Message::where('sender_id', $authUserId)->pluck('receiver_id'))
            ->unique()
            ->reject(fn($id) => $id == $authUserId);

        return User::whereIn('user_id', $userIds)->where('role_id', 2)->get();
    }

    public function getConversation(User $user)
    {
        $authUserId = Auth::id();

        return Message::with(['attachments' => function($q){ $q->orderBy('attachment_id'); }])->where(function($q) use ($authUserId, $user){
            $q->where('sender_id', $authUserId)->where('receiver_id', $user->user_id);
        })->orWhere(function($q) use ($authUserId, $user){
            $q->where('sender_id', $user->user_id)->where('receiver_id', $authUserId);
        })->orderBy('created_at')->get();
    }

    public function sendMessage(User $receiver, ?string $content, array $attachments = [])
    {
        $authId = Auth::id();

        Message::where('sender_id', $receiver->user_id)
            ->where('receiver_id', $authId)
            ->where('admin_replied', false)
            ->update(['admin_replied' => true, 'read_at' => now()]);

        $message = Message::create([
            'sender_id' => $authId,
            'receiver_id' => $receiver->user_id,
            'content' => $content,
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

            $thumbPath = $type === 'video' ? $this->generateVideoThumbnail($storedPath) : null;

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
            // Capture a frame at 1s
            @shell_exec("ffmpeg -y -ss 00:00:01 -i $srcArg -vframes 1 -vf scale='640:-1' $dstArg 2>NUL");
            return file_exists($thumbAbs) ? $thumbRel : null;
        } catch (\Throwable) {
            return null;
        }
    }
}

