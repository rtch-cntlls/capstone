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
                        <img src="{{ asset('storage/images/EmptyMessage.gif')}}" alt="empty" width="250">
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
                                    @if(isset($message->attachments) && $message->attachments->count())
                                        @foreach($message->attachments as $att)
                                            @if($att->attachment_type === 'image')
                                                <img src="{{ route('media.attachment', $att->attachment_id) }}?v={{ $message->created_at->timestamp }}" alt="image" class="rounded mb-1" style="max-width:120px; max-height:120px; cursor:pointer;" data-attachment-id="{{ $att->attachment_id }}"/>
                                            @elseif($att->attachment_type === 'video')
                                                <video class="rounded mb-1" style="max-width:120px; max-height:120px; cursor:pointer;" @if($att->thumbnail_path) poster="{{ route('media.attachment.thumbnail', $att->attachment_id) }}?v={{ $message->created_at->timestamp }}" @endif data-attachment-id="{{ $att->attachment_id }}">
                                                    <source src="{{ route('media.attachment', $att->attachment_id) }}?v={{ $message->created_at->timestamp }}" type="{{ $att->mime_type ?? 'video/mp4' }}">
                                                </video>
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
                        @endforeach
                    @else
                        <p class="text-center text-muted">No messages yet.</p>
                    @endif
                @else
                    <p class="text-center text-muted">Select a customer to view messages.</p>
                @endif
            </div>
            @if($selectedUser)
                <form id="sendMessageForm" action="{{ route('admin.messages.send', $selectedUser->user_id) }}" method="POST" class="d-flex align-items-center gap-2" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="content" class="form-control" placeholder="Type a message...">
                    <input id="attachmentsInput" type="file" name="attachments[]" class="d-none" accept="image/*,video/*" multiple>
                    <button type="button" id="attachmentsBtn" class="btn btn-outline-secondary" title="Upload" aria-label="Upload">
                        <i class="fas fa-image"></i>
                    </button>
                    <button type="submit" class="btn btn-success">Send</button>
                </form>
                <div id="attachmentsPreview" class="d-flex flex-wrap gap-2 mt-2"></div>
                <div class="progress mt-2 d-none" id="uploadProgressWrap">
                    <div id="uploadProgress" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
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
            const blobCache = window.__mediaBlobCache || (window.__mediaBlobCache = {});
            messages.forEach(message => {
                const div = document.createElement('div');
                div.className = `mb-2 d-flex ${message.sender_id == authUserId ? 'justify-content-end' : 'justify-content-start'}`;
                let mediaHtml = '';
                if (Array.isArray(message.attachments) && message.attachments.length) {
                    mediaHtml = message.attachments.map(att => {
                        const key = `att_${att.attachment_id}`;
                        const url = blobCache[key] || '';
                        if (att.attachment_type === 'image') {
                            const srcAttr = url ? `src=\"${url}\"` : '';
                            return `<img data-attachment-id=\"${att.attachment_id}\" ${srcAttr} alt=\"image\" class=\"rounded mb-1\" style=\"max-width:120px; max-height:120px; cursor:pointer;\"/>`;
                        } else if (att.attachment_type === 'video') {
                            const posterKey = att.thumbnail_path ? `att_thumb_${att.attachment_id}` : null;
                            const posterUrl = posterKey && blobCache[posterKey] ? blobCache[posterKey] : '';
                            const posterAttr = posterUrl ? `poster=\"${posterUrl}\"` : '';
                            const srcAttr = url ? `src=\"${url}\"` : '';
                            return `<video data-attachment-id=\"${att.attachment_id}\" class=\"rounded mb-1\" style=\"max-width:120px; max-height:120px; cursor:pointer;\" ${posterAttr}><source ${srcAttr} type=\"${att.mime_type || 'video/mp4'}\"></video>`;
                        }
                        return '';
                    }).join('');
                }
                const textHtml = message.content ? message.content : '';
                const dt = new Date(message.created_at);
                const ts = dt.toLocaleString(undefined, { weekday: 'short', hour: '2-digit', minute: '2-digit' });
                div.innerHTML = `
                    <div class="p-2 rounded ${message.sender_id == authUserId ? 'border bg-light' : 'bg-light border'}" style="max-width:70%;">
                        ${mediaHtml}${textHtml}
                        <div class="form-text text-end mt-1" style="font-size:10px;">${ts}</div>
                    </div>
                `;
                messagesContainer.appendChild(div);

                // Fetch blobs for attachments not cached
                if (Array.isArray(message.attachments)) {
                    message.attachments.forEach(att => {
                        const key = `att_${att.attachment_id}`;
                        if (!blobCache[key]) {
                            const mediaUrl = `${window.location.origin}/media/attachments/${att.attachment_id}?v=${Date.now()}`;
                            fetch(mediaUrl, { cache: 'no-store' })
                                .then(r => r.ok ? r.blob() : Promise.reject())
                                .then(b => {
                                    const objUrl = URL.createObjectURL(b);
                                    blobCache[key] = objUrl;
                                    const el = messagesContainer.querySelector(`[data-attachment-id="${att.attachment_id}"]`);
                                    if (el && el.tagName.toLowerCase() === 'img') {
                                        el.src = objUrl;
                                    } else if (el && el.tagName.toLowerCase() === 'video') {
                                        const source = el.querySelector('source');
                                        if (source) { source.src = objUrl; el.load(); }
                                    }
                                }).catch(()=>{});
                        }
                        if (att.thumbnail_path) {
                            const tkey = `att_thumb_${att.attachment_id}`;
                            if (!blobCache[tkey]) {
                                const thumbUrl = `${window.location.origin}/media/attachments/${att.attachment_id}/thumbnail?v=${Date.now()}`;
                                fetch(thumbUrl, { cache: 'no-store' })
                                    .then(r => r.ok ? r.blob() : Promise.reject())
                                    .then(b => {
                                        const objUrl = URL.createObjectURL(b);
                                        blobCache[tkey] = objUrl;
                                        const v = messagesContainer.querySelector(`video[data-attachment-id="${att.attachment_id}"]`);
                                        if (v) { v.poster = objUrl; }
                                    }).catch(()=>{});
                            }
                        }
                    });
                }
            });
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        })
        .catch(err => console.error(err));
}

setInterval(fetchMessages, 3000);

messagesContainer.scrollTop = messagesContainer.scrollHeight;

const sendForm = document.getElementById('sendMessageForm');
const attachmentsInput = document.getElementById('attachmentsInput');
const attachmentsBtn = document.getElementById('attachmentsBtn');
const attachmentsPreview = document.getElementById('attachmentsPreview');
const progressWrap = document.getElementById('uploadProgressWrap');
const progressBar = document.getElementById('uploadProgress');
let pendingFiles = [];

if (attachmentsBtn && attachmentsInput) {
    attachmentsBtn.addEventListener('click', () => attachmentsInput.click());
    attachmentsInput.addEventListener('change', () => {
        const files = Array.from(attachmentsInput.files || []);
        files.forEach(file => pendingFiles.push(file));
        attachmentsInput.value = '';
        renderPendingPreviews();
    });
}

function renderPendingPreviews(){
    attachmentsPreview.innerHTML = '';
    pendingFiles.forEach((file, idx) => {
        const url = URL.createObjectURL(file);
        const wrapper = document.createElement('div');
        wrapper.style.width = '80px';
        wrapper.style.height = '80px';
        wrapper.style.position = 'relative';
        wrapper.className = 'border rounded d-flex align-items-center justify-content-center overflow-hidden me-2 mb-2';
        let contentEl;
        if (file.type.startsWith('image/')) {
            contentEl = document.createElement('img');
            contentEl.src = url;
            contentEl.style.maxWidth = '100%';
            contentEl.style.maxHeight = '100%';
        } else if (file.type.startsWith('video/')) {
            contentEl = document.createElement('video');
            contentEl.src = url;
            contentEl.muted = true;
            contentEl.playsInline = true;
            contentEl.style.maxWidth = '100%';
            contentEl.style.maxHeight = '100%';
        } else {
            contentEl = document.createElement('span');
            contentEl.textContent = file.name;
            contentEl.style.fontSize = '12px';
            contentEl.style.padding = '4px';
        }
        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.setAttribute('aria-label','Remove');
        removeBtn.style.position = 'absolute';
        removeBtn.style.top = '4px';
        removeBtn.style.right = '4px';
        removeBtn.style.width = '24px';
        removeBtn.style.height = '24px';
        removeBtn.style.border = 'none';
        removeBtn.style.borderRadius = '9999px';
        removeBtn.style.background = 'rgba(0,0,0,.6)';
        removeBtn.style.color = '#fff';
        removeBtn.style.display = 'inline-flex';
        removeBtn.style.alignItems = 'center';
        removeBtn.style.justifyContent = 'center';
        removeBtn.innerHTML = '&times;';
        removeBtn.addEventListener('click', () => {
            pendingFiles.splice(idx,1);
            renderPendingPreviews();
        });
        wrapper.appendChild(contentEl);
        wrapper.appendChild(removeBtn);
        attachmentsPreview.appendChild(wrapper);
    });
}

if(sendForm){
    sendForm.addEventListener('submit', function(e){
        e.preventDefault();
        const formData = new FormData(sendForm);
        const sendBtn = sendForm.querySelector('button[type="submit"]');
        if (sendBtn) sendBtn.disabled = true;
        if (attachmentsBtn) attachmentsBtn.disabled = true;
        // Append all pending files explicitly to ensure multiple selections are included
        pendingFiles.forEach(f => formData.append('attachments[]', f));
        progressWrap.classList.remove('d-none');
        const xhr = new XMLHttpRequest();
        xhr.open('POST', sendForm.action, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', formData.get('_token'));
        xhr.upload.onprogress = function(evt){
            if(evt.lengthComputable){
                const percent = Math.round((evt.loaded/evt.total)*100);
                progressBar.style.width = percent + '%';
                progressBar.setAttribute('aria-valuenow', String(percent));
                progressBar.textContent = percent + '%';
            }
        };
        xhr.onload = function(){
            progressWrap.classList.add('d-none');
            progressBar.style.width = '0%';
            progressBar.textContent = '0%';
            fetchMessages();
            sendForm.reset();
            pendingFiles = [];
            attachmentsPreview.innerHTML = '';
            if (attachmentsInput) attachmentsInput.value = '';
            if (sendBtn) sendBtn.disabled = false;
            if (attachmentsBtn) attachmentsBtn.disabled = false;
        };
        xhr.onerror = function(){
            progressWrap.classList.add('d-none');
            if (sendBtn) sendBtn.disabled = false;
            if (attachmentsBtn) attachmentsBtn.disabled = false;
        };
        xhr.onabort = function(){
            progressWrap.classList.add('d-none');
            if (sendBtn) sendBtn.disabled = false;
            if (attachmentsBtn) attachmentsBtn.disabled = false;
        };
        xhr.send(formData);
    });
}

// Click-to-preview modal (admin)
messagesContainer.addEventListener('click', (e) => {
    const img = e.target.closest('img[data-attachment-id]');
    const vid = e.target.closest('video[data-attachment-id]');
    const modalEl = document.getElementById('adminPreviewModal');
    if (!modalEl) return;
    const imgEl = document.getElementById('adminPreviewImage');
    const vidEl = document.getElementById('adminPreviewVideo');
    const vidSrc = document.getElementById('adminPreviewVideoSrc');
    const dl = document.getElementById('adminPreviewDownload');
    const bsModal = new bootstrap.Modal(modalEl);
    if (img) {
        imgEl.style.display = 'block';
        vidEl.style.display = 'none';
        imgEl.src = img.src;
        if (img && dl) dl.href = `${window.location.origin}/media/attachments/${img.dataset.attachmentId || img.getAttribute('data-attachment-id')}?download=1`;
        bsModal.show();
    } else if (vid) {
        imgEl.style.display = 'none';
        vidEl.style.display = 'block';
        const source = vid.querySelector('source');
        if (source) {
            vidSrc.src = source.src;
            vidEl.load();
        }
        if (vid && dl) dl.href = `${window.location.origin}/media/attachments/${vid.dataset.attachmentId || vid.getAttribute('data-attachment-id')}?download=1`;
        bsModal.show();
    }
});

// Ensure video stops and scroll to bottom on admin modal close
const adminModal = document.getElementById('adminPreviewModal');
if (adminModal) {
    adminModal.addEventListener('hidden.bs.modal', () => {
        try {
            const v = document.getElementById('adminPreviewVideo');
            const vs = document.getElementById('adminPreviewVideoSrc');
            if (v) { v.pause(); v.currentTime = 0; }
            if (vs) { vs.src = ''; if (v) v.load(); }
        } catch (_) {}
        try {
            const img = document.getElementById('adminPreviewImage');
            if (img) img.removeAttribute('src');
        } catch (_) {}
        const messagesContainerEl = document.getElementById('messagesContainer');
        if (messagesContainerEl) messagesContainerEl.scrollTop = messagesContainerEl.scrollHeight;
    });
}
</script>
<!-- Admin Preview Modal -->
<div class="modal fade preview-modal" id="adminPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content" style="background: transparent; border: 0; box-shadow: none; position: relative;">
            <a id="adminPreviewDownload" href="#" download class="preview-download" title="Download" aria-label="Download">
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
                <img id="adminPreviewImage" class="preview-media" src="" alt="preview" style="display:none;"/>
                <video id="adminPreviewVideo" class="preview-media" controls style="display:none;"><source id="adminPreviewVideoSrc" src="" type="video/mp4"></video>
            </div>
        </div>
    </div>
</div>
<style>
    .preview-media{ max-width: 100%; max-height: calc(100vh - 140px); width: auto; height: auto; object-fit: contain; background: transparent; }
    .preview-modal .modal-dialog{ margin: 0 auto; }
    .preview-modal .modal-backdrop{ background: rgba(0,0,0,0.7); }
    .preview-modal .modal-content{ background: transparent; position: relative; }
    .preview-modal .preview-close{ position: absolute; top: 12px; right: 12px; z-index: 1060; filter: drop-shadow(0 2px 4px rgba(0,0,0,.5)); background: rgba(0,0,0,.35); border-radius: 50%; padding: 10px; box-sizing: content-box; }
    .preview-modal .preview-download{ position: absolute; top: 12px; right: 60px; z-index: 1060; display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(0,0,0,.45); border-radius: 9999px; padding: 0; cursor: pointer; text-decoration: none; }
    .preview-modal .preview-download:hover{ background: rgba(0,0,0,.6); }
    .preview-modal .preview-close:focus{ outline: none; box-shadow: none; }
</style>
@endif
@endsection
