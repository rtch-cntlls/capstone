document.getElementById('chatToggleBtn').addEventListener('click', function () {
    document.getElementById('chatbotBox').style.display = 'block';
    this.style.display = 'none';
});

document.getElementById('chatCloseBtn').addEventListener('click', function () {
    document.getElementById('chatbotBox').style.display = 'none';
    document.getElementById('chatToggleBtn').style.display = 'inline-block';
});
