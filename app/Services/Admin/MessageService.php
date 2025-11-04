<?php

namespace App\Services\Admin;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        return Message::where(function($q) use ($authUserId, $user){
            $q->where('sender_id', $authUserId)->where('receiver_id', $user->user_id);
        })->orWhere(function($q) use ($authUserId, $user){
            $q->where('sender_id', $user->user_id)->where('receiver_id', $authUserId);
        })->orderBy('created_at')->get();
    }

    public function sendMessage(User $receiver, string $content)
    {
        return Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiver->user_id,
            'content' => $content,
        ]);
    }
}
