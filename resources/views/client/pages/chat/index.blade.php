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
                            <div class="p-2 bg-primary text-white rounded-3">
                                @if(isset($message->attachments) && $message->attachments->count())
                                    @foreach($message->attachments as $att)
                                        @if($att->attachment_type === 'image')
                                            <img src="{{ route('media.attachment', $att->attachment_id) }}" alt="image" class="rounded mb-1" style="max-width:120px; max-height:120px; cursor:pointer;" data-preview-src="{{ route('media.attachment', $att->attachment_id) }}" data-attachment-id="{{ $att->attachment_id }}"/>
                                        @elseif($att->attachment_type === 'video')
                                            <video class="rounded mb-1" style="max-width:120px; max-height:120px; cursor:pointer;" @if($att->thumbnail_path) poster="{{ route('media.attachment.thumbnail', $att->attachment_id) }}" @endif data-preview-src="{{ route('media.attachment', $att->attachment_id) }}" data-preview-type="{{ $att->mime_type ?? 'video/mp4' }}" data-attachment-id="{{ $att->attachment_id }}"></video>
                                        @endif
                                    @endforeach
                                @endif
                                @if(!empty($message->content))
                                    {{ $message->content }}
                                @endif
                                <div class="form-text text-end mt-1" style="font-size: 10px;">
                                    {{ $message->created_at->format('D h:i A') }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="d-flex justify-content-start mb-2">
                            <div class="p-2 bg-light rounded-3">
                                @if(isset($message->attachments) && $message->attachments->count())
                                    @foreach($message->attachments as $att)
                                        @if($att->attachment_type === 'image')
                                            <img src="{{ route('media.attachment', $att->attachment_id) }}" alt="image" class="rounded mb-1" style="max-width:120px; max-height:120px; cursor:pointer;" data-preview-src="{{ route('media.attachment', $att->attachment_id) }}" data-attachment-id="{{ $att->attachment_id }}"/>
                                        @elseif($att->attachment_type === 'video')
                                            <video class="rounded mb-1" style="max-width:120px; max-height:120px; cursor:pointer;" @if($att->thumbnail_path) poster="{{ route('media.attachment.thumbnail', $att->attachment_id) }}" @endif data-preview-src="{{ route('media.attachment', $att->attachment_id) }}" data-preview-type="{{ $att->mime_type ?? 'video/mp4' }}" data-attachment-id="{{ $att->attachment_id }}"></video>
                                        @endif
                                    @endforeach
                                @endif
                                @if(!empty($message->content))
                                    {{ $message->content }}
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="card-footer bg-white">
                <form id="customerSendForm" class="d-flex align-items-center gap-2" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
                    <input type="text" name="content" class="form-control" placeholder="Type a message...">
                    <input id="chatAttachmentsInput" type="file" name="attachments[]" class="d-none" accept="image/*,video/*" multiple>
                    <button type="button" id="chatAttachmentsBtn" class="btn btn-outline-secondary" title="Upload" aria-label="Upload">
                        <i class="fas fa-image"></i>
                    </button>
                    <button class="btn btn-primary" type="submit">Send</button>
                </form>
                <div id="chatAttachmentsPreview" class="d-flex flex-wrap gap-2 mt-2"></div>
                <div class="progress mt-2 d-none" id="chatUploadProgressWrap">
                    <div id="chatUploadProgress" class="progress-bar" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.authUserId = {{ Auth::id() }};
        window.messagePollUrl = '{{ route("message.poll") }}';
        window.messageStoreUrl = '{{ route("message.store") }}';
    </script>
    <script src="{{ asset('script/customer/chatbox.js') }}"></script>
    <!-- Preview Modal -->
    <div class="modal fade preview-modal" id="chatPreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" style="background: transparent; border: 0; box-shadow: none; position: relative;">
                <a id="chatPreviewDownload" href="#" download class="preview-download" title="Download" aria-label="Download">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                </a>
                <button type="button" class="preview-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="modal-body text-center p-0 d-flex align-items-center justify-content-center" style="background: transparent;">
                    <img id="chatPreviewImage" class="preview-media" src="" alt="preview" style="display:none;"/>
                    <video id="chatPreviewVideo" class="preview-media" controls style="display:none;"><source id="chatPreviewVideoSrc" src="" type="video/mp4"></video>
                </div>
            </div>
        </div>
    </div>
    <style>
        .preview-media{ max-width: 100%; max-height: calc(100vh - 140px); width: auto; height: auto; object-fit: contain; background: transparent; position: relative; z-index: 1; }
        .preview-modal .modal-dialog{ margin: 0 auto; }
        .preview-modal .preview-close{ position: absolute; top: 12px; right: 12px; z-index: 1060; display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(0,0,0,.45); border: none; border-radius: 9999px; padding: 0; cursor: pointer; }
        .preview-modal .preview-close:hover{ background: rgba(0,0,0,.6); }
        .preview-modal .preview-close:focus{ outline: none; box-shadow: 0 0 0 2px rgba(255,255,255,.35); }
        .preview-modal .preview-close:focus{ outline: none; box-shadow: none; }
        .preview-modal .preview-download{ position: absolute; top: 12px; right: 60px; z-index: 1060; display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(0,0,0,.45); border-radius: 9999px; padding: 0; cursor: pointer; text-decoration: none; }
        .preview-modal .preview-download:hover{ background: rgba(0,0,0,.6); }
    </style>
@endif
