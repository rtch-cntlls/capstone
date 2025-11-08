<?php

namespace App\Services\Shop;

use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

            MessageAttachment::create([
                'message_id' => $message->message_id,
                'attachment_path' => $storedPath,
                'attachment_type' => $type,
                'mime_type' => $mime,
                'thumbnail_path' => null,
            ]);
        }

        return $message->load('attachments');
    }
}

