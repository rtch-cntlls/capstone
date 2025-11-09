document.addEventListener('DOMContentLoaded', () => {
    const chatBox = document.getElementById('chatbotBox');
    const toggleBtn = document.getElementById('chatToggleBtn');
    const closeBtn = document.getElementById('chatCloseBtn');
    const chatMessages = document.getElementById('chatMessages');
    const customerForm = document.getElementById('customerSendForm');
    const attachmentsInput = document.getElementById('chatAttachmentsInput');
    const attachmentsBtn = document.getElementById('chatAttachmentsBtn');
    const attachmentsPreview = document.getElementById('chatAttachmentsPreview');
    let pendingFiles = [];
    const progressWrap = document.getElementById('chatUploadProgressWrap');
    const progressBar = document.getElementById('chatUploadProgress');

    if (!toggleBtn || !chatBox || !closeBtn || !chatMessages || !customerForm) return;

    toggleBtn.addEventListener('click', () => {
        chatBox.style.display = 'block';
        toggleBtn.style.display = 'none';
        chatMessages.scrollTop = chatMessages.scrollHeight;
    });

    closeBtn.addEventListener('click', () => {
        chatBox.style.display = 'none';
        toggleBtn.style.display = 'flex';
    });

    function fetchMessages() {
        fetch(window.messagePollUrl, { cache: 'no-store' })
            .then(res => res.json())
            .then(messages => {
                chatMessages.innerHTML = '';
                const blobCache = window.__mediaBlobCache || (window.__mediaBlobCache = {});
                messages.forEach(message => {
                    const div = document.createElement('div');
                    const isSender = message.sender_id == window.authUserId;
                    div.className = 'mb-2 d-flex ' + (isSender ? 'justify-content-end' : 'justify-content-start');
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
                        <div class="p-2 rounded ${isSender ? 'bg-primary text-white' : 'bg-light'}">
                            ${mediaHtml}${textHtml}
                            <div class="form-text text-end mt-1" style="font-size:10px;">${ts}</div>
                        </div>`;
                    chatMessages.appendChild(div);

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
                                        const el = chatMessages.querySelector(`[data-attachment-id="${att.attachment_id}"]`);
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
                                            const v = chatMessages.querySelector(`video[data-attachment-id="${att.attachment_id}"]`);
                                            if (v) { v.poster = objUrl; }
                                        }).catch(()=>{});
                                }
                            }
                        });
                    }
                });
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(err => console.error('Fetch error:', err));
    }

    setInterval(fetchMessages, 3000);

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

    customerForm.addEventListener('submit', e => {
        e.preventDefault();
        const formData = new FormData(customerForm);
        const sendBtn = customerForm.querySelector('button[type="submit"]');
        if (sendBtn) sendBtn.disabled = true;
        if (attachmentsBtn) attachmentsBtn.disabled = true;
        // Append all pending files to ensure multiple are sent
        pendingFiles.forEach(f => formData.append('attachments[]', f));
        if (progressWrap) progressWrap.classList.remove('d-none');
        const xhr = new XMLHttpRequest();
        xhr.open('POST', window.messageStoreUrl, true);
        const tokenInput = customerForm.querySelector('input[name="_token"]');
        if (tokenInput) xhr.setRequestHeader('X-CSRF-TOKEN', tokenInput.value);
        xhr.upload.onprogress = function(evt){
            if(evt.lengthComputable && progressBar){
                const percent = Math.round((evt.loaded/evt.total)*100);
                progressBar.style.width = percent + '%';
                progressBar.setAttribute('aria-valuenow', String(percent));
                progressBar.textContent = percent + '%';
            }
        };
        xhr.onload = function(){
            if (progressWrap) progressWrap.classList.add('d-none');
            if (progressBar) {progressBar.style.width = '0%'; progressBar.textContent = '0%';}
            fetchMessages();
            customerForm.reset();
            pendingFiles = [];
            if (attachmentsPreview) attachmentsPreview.innerHTML = '';
            if (attachmentsInput) attachmentsInput.value = '';
            if (sendBtn) sendBtn.disabled = false;
            if (attachmentsBtn) attachmentsBtn.disabled = false;
        };
        xhr.onerror = function(){
            if (progressWrap) progressWrap.classList.add('d-none');
            if (sendBtn) sendBtn.disabled = false;
            if (attachmentsBtn) attachmentsBtn.disabled = false;
        };
        xhr.onabort = function(){
            if (progressWrap) progressWrap.classList.add('d-none');
            if (sendBtn) sendBtn.disabled = false;
            if (attachmentsBtn) attachmentsBtn.disabled = false;
        };
        xhr.send(formData);
    });

    // Click-to-preview modal
    chatMessages.addEventListener('click', (e) => {
        const img = e.target.closest('img[data-attachment-id]');
        const vid = e.target.closest('video[data-attachment-id]');
        const modalEl = document.getElementById('chatPreviewModal');
        if (!modalEl) return;
        const imgEl = document.getElementById('chatPreviewImage');
        const vidEl = document.getElementById('chatPreviewVideo');
        const vidSrc = document.getElementById('chatPreviewVideoSrc');
        const dl = document.getElementById('chatPreviewDownload');
        const bsModal = new bootstrap.Modal(modalEl);
        if (img) {
            imgEl.style.display = 'block';
            vidEl.style.display = 'none';
            imgEl.src = img.src;
            if (dl) dl.href = `${window.location.origin}/media/attachments/${img.dataset.attachmentId || img.getAttribute('data-attachment-id')}?download=1`;
            bsModal.show();
        } else if (vid) {
            imgEl.style.display = 'none';
            vidEl.style.display = 'block';
            const source = vid.querySelector('source');
            if (source) {
                vidSrc.src = source.src;
                vidEl.load();
            }
            if (dl) dl.href = `${window.location.origin}/media/attachments/${vid.dataset.attachmentId || vid.getAttribute('data-attachment-id')}?download=1`;
            bsModal.show();
        }
    });

    // Ensure video stops and scroll to bottom on modal close
    const previewModal = document.getElementById('chatPreviewModal');
    if (previewModal) {
        previewModal.addEventListener('hidden.bs.modal', () => {
            try {
                const v = document.getElementById('chatPreviewVideo');
                const vs = document.getElementById('chatPreviewVideoSrc');
                if (v) { v.pause(); v.currentTime = 0; }
                if (vs) { vs.src = ''; if (v) v.load(); }
            } catch (_) {}
            try {
                const img = document.getElementById('chatPreviewImage');
                if (img) img.removeAttribute('src');
            } catch (_) {}
            // scroll to latest message
            if (chatMessages) chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    }
});
