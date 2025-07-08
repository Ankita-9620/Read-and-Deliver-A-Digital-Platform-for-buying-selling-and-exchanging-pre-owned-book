function toggleMessageForm() {
    const form = document.getElementById('messageForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function sendMessage() {
    const name = document.getElementById('userName').value;
    const message = document.getElementById('userMessage').value;

    if (name && message) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'send_message.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Message sent!');
                document.getElementById('userName').value = '';
                document.getElementById('userMessage').value = '';
                toggleMessageForm();
            }
        };
        xhr.send('name=' + encodeURIComponent(name) + '&message=' + encodeURIComponent(message));
    } else {
        alert('Please enter both name and message.');
    }
}