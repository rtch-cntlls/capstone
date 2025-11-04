<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Admin\MessageService;

class MessagesController extends Controller
{
    protected MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index($user_id = null)
    {
        $customers = $this->messageService->getMessagedCustomers();
        $messages = collect();
        $selectedUser = null;

        if ($user_id) {
            $selectedUser = User::findOrFail($user_id);
            $messages = $this->messageService->getConversation($selectedUser);
        }

        return view('admin.pages.messages.index', compact('customers', 'messages', 'selectedUser'));
    }

    public function send(Request $request, User $user)
    {
        $request->validate(['content' => 'required|string|max:1000']);
        $this->messageService->sendMessage($user, $request->content);

        return redirect()->route('admin.messages.index', $user->user_id);
    }

    public function poll(User $user)
    {
        $messages = $this->messageService->getConversation($user);
        return response()->json($messages);
    }
}
