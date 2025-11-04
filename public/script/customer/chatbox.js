document.addEventListener('DOMContentLoaded', () => {
    const chatBox = document.getElementById('chatbotBox');
    const toggleBtn = document.getElementById('chatToggleBtn');
    const closeBtn = document.getElementById('chatCloseBtn');
    const chatMessages = document.getElementById('chatMessages');
    const customerForm = document.getElementById('customerSendForm');

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
        fetch(window.messagePollUrl)
            .then(res => res.json())
            .then(messages => {
                chatMessages.innerHTML = '';
                messages.forEach(message => {
                    const div = document.createElement('div');
                    const isSender = message.sender_id == window.authUserId;
                    div.className = 'mb-2 d-flex ' + (isSender ? 'justify-content-end' : 'justify-content-start');
                    div.innerHTML = `
                        <div class="p-2 rounded ${isSender ? 'bg-primary text-white' : 'bg-light'}">
                            ${message.content}
                        </div>`;
                    chatMessages.appendChild(div);
                });
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(err => console.error('Fetch error:', err));
    }

    setInterval(fetchMessages, 3000);

    customerForm.addEventListener('submit', e => {
        e.preventDefault();
        const formData = new FormData(customerForm);
        fetch(window.messageStoreUrl, {
            method: 'POST',
            body: formData
        })
        .then(() => {
            fetchMessages();
            customerForm.reset();
        })
        .catch(err => console.error('Send error:', err));
    });
});
