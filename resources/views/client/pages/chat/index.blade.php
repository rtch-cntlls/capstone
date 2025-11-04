@if(Auth::check() && isset($receiverId) && $receiverId)
    <button id="chatToggleBtn" class="btn btn-success rounded-circle shadow-lg"
            style="position:fixed; bottom:20px; right:20px; width:60px; height:60px; z-index:1050;">
        <i class="fas fa-comments"></i>
    </button>
    <div id="chatbotBox" style="position:fixed; bottom:0; right:20px; width:350px; max-width:90%; display:none; z-index:1051;">
        <div class="card shadow-lg rounded-4 border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span>Chat with Admin</span>
                <button id="chatCloseBtn" class="btn-close btn-close-white"></button>
            </div>
            <div id="chatMessages" class="card-body" style="height:300px; overflow:auto;">
                @foreach($messages as $message)
                    @if($message->sender_id == Auth::id())
                        <div class="d-flex justify-content-end mb-2">
                            <div class="p-2 bg-primary text-white rounded-3">{{ $message->content }}</div>
                        </div>
                    @else
                        <div class="d-flex justify-content-start mb-2">
                            <div class="p-2 bg-light rounded-3">{{ $message->content }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="card-footer bg-white">
                <form id="customerSendForm" class="d-flex">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
                    <input type="text" name="content" class="form-control me-2" placeholder="Type a message..." required>
                    <button class="btn btn-primary" type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.authUserId = {{ Auth::id() }};
        window.messagePollUrl = '{{ route("message.poll") }}';
        window.messageStoreUrl = '{{ route("message.store") }}';
    </script>
    <script src="{{ asset('script/customer/chatbox.js') }}"></script>
@endif
