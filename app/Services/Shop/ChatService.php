<?php

namespace App\Services\Shop;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatService
{
    public function getMessagesWithAdmin()
    {
        $adminId = User::where('role_id', 1)->value('user_id');

        $messages = Message::where(function($q) use ($adminId){
            $q->where('sender_id', Auth::id())->where('receiver_id', $adminId);
        })->orWhere(function($q) use ($adminId){
            $q->where('sender_id', $adminId)->where('receiver_id', Auth::id());
        })->orderBy('created_at')->get();

        return ['messages'=>$messages, 'receiverId'=>$adminId];
    }

    public function sendMessage($receiverId, $content)
    {
        return Message::create([
            'sender_id'=>Auth::id(),
            'receiver_id'=>$receiverId,
            'content'=>$content,
        ]);
    }
}

