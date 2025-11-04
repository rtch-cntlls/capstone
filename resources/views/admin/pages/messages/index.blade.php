@extends('admin.layouts.admin')
@section('content')
<div class="p-2 mt-3">
    <h4 class="fw-bold">Messages</h4>
</div>
<div class="p-2">
    <div class="row px-0">
        <div class="col-12 d-md-none mb-3">
            <div class="d-flex overflow-auto">
                @if(!$customers->isEmpty())
                    @foreach($customers as $customer)
                        <a href="{{ route('admin.messages.index', $customer->user_id) }}"
                            class="d-flex flex-column align-items-center text-decoration-none me-3">
                            <img src="{{ $customer->profile ?? asset('profile/customer.webp') }}" 
                                 alt="Profile Picture" width="50" height="50" class="rounded-circle mb-1">
                            <span class="small text-center">{{ Str::limit($customer->firstname, 6) }}</span>
                        </a>
                    @endforeach
                @else
                    <p class="text-center text-muted w-100">No customers.</p>
                @endif
            </div>
        </div>
        <div class="col-md-4 d-none d-md-block" style="height: 65vh; overflow-y: auto;">
            <ul class="list-group p-2">
                @if(!$customers->isEmpty())
                    @foreach($customers as $customer)
                        <a href="{{ route('admin.messages.index', $customer->user_id) }}"
                            class="d-flex align-items-center p-2 text-decoration-none border-bottom">
                            <img src="{{ $customer->profile ?? asset('profile/customer.webp') }}" 
                                 alt="Profile Picture" width="30" class="rounded-circle me-2">
                            <div>
                                {{ $customer->firstname }} {{ $customer->lastname }}
                                <div class="text-muted" style="font-size: 12px;">
                                    Message you
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="text-center mt-5">
                        <img src="{{ asset('images/EmptyMessage.gif')}}" alt="empty" width="250">
                        <p class="mt-3 text-danger small">No messages.</p>
                    </div>
                @endif
            </ul>
        </div>
        <div class="col-12 col-md-8" style="height: 60vh; display: flex; flex-direction: column;">
            <div id="messagesContainer" class="border rounded p-3 mb-3 flex-grow-1 overflow-auto bg-white">
                @if($selectedUser)
                    @if(!$messages->isEmpty())
                        @foreach($messages as $message)
                            <div class="mb-2 d-flex {{ $message->sender_id == auth()->user()->user_id ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="p-2 rounded {{ $message->sender_id == auth()->user()->user_id ? 'border bg-light' : 'bg-light border' }}" style="max-width: 70%;">
                                    {{ $message->content }} 
                                    <div class="form-text text-end mt-1" style="font-size: 10px;">
                                        {{ $message->created_at->format('D h:i A') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted">No messages yet.</p>
                    @endif
                @else
                    <p class="text-center text-muted">Select a customer to view messages.</p>
                @endif
            </div>
            @if($selectedUser)
                <form id="sendMessageForm" action="{{ route('admin.messages.send', $selectedUser->user_id) }}" method="POST" class="d-flex">
                    @csrf
                    <input type="text" name="content" class="form-control me-2" placeholder="Type a message..." required>
                    <button type="submit" class="btn btn-success">Send</button>
                </form>
            @endif
        </div>
    </div>
</div>

@if($selectedUser)
<script>
const selectedUserId = {{ $selectedUser->user_id }};
const authUserId = {{ auth()->user()->user_id }};
const messagesContainer = document.getElementById('messagesContainer');

function fetchMessages() {
    fetch(`/admin/messages/poll/${selectedUserId}`)
        .then(res => res.json())
        .then(messages => {
            messagesContainer.innerHTML = '';
            messages.forEach(message => {
                const div = document.createElement('div');
                div.className = `mb-2 d-flex ${message.sender_id == authUserId ? 'justify-content-end' : 'justify-content-start'}`;
                div.innerHTML = `
                    <div class="p-2 rounded ${message.sender_id == authUserId ? 'border bg-light' : 'bg-light border'}" style="max-width:70%;">
                        ${message.content}
                        <div class="form-text text-end mt-1" style="font-size:10px;">
                            ${new Date(message.created_at).toLocaleString()}
                        </div>
                    </div>
                `;
                messagesContainer.appendChild(div);
            });
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        })
        .catch(err => console.error(err));
}

setInterval(fetchMessages, 3000);

messagesContainer.scrollTop = messagesContainer.scrollHeight;

const sendForm = document.getElementById('sendMessageForm');
if(sendForm){
    sendForm.addEventListener('submit', function(e){
        e.preventDefault();
        const formData = new FormData(sendForm);
        fetch(sendForm.action, {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': formData.get('_token')},
            body: formData
        }).then(()=>{
            fetchMessages();
            sendForm.reset();
        });
    });
}
</script>
@endif
@endsection
