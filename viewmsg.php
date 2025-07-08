<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Messages</title>
    <style>
        /* General body styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('images/back3.jpg') no-repeat center center fixed; /* Background image */
            background-size: cover; /* Cover the entire viewport */
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            overflow: hidden; /* Prevent scrollbars */
        }

        /* Header styles */
        h1 {
            text-align: center;
            color: #444;
            margin: 20px 0;
            font-size: 36px;
            animation: fadeIn 1.5s ease-in-out;
            width: 100%;
            background: rgba(102, 166, 255, 0.8); /* Semi-transparent background */
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Container for the messages section */
        .container {
            display: flex;
            justify-content: space-between;
            width: 80%;
            max-width: 1200px;
            margin-top: 20px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Left section for messages */
        .messages-container {
            width: 65%;
            max-width: 800px;
            margin-right: 20px;
            padding: 20px;
            background: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow-y: auto;
        }

        /* Right section for buyer/seller icons */
        .communication-container {
            width: 30%;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            background-color: #f1f1f1;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .communication-container img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
        }

        .communication-icon {
            font-size: 40px;
            color: #007bff;
            margin: 20px 0;
        }

        /* Messages table styling for better presentation */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #66a6ff;
            color: white;
        }

        td {
            background: #f9f9f9;
        }

        /* Button styles for reply and ignore buttons */
        .reply-btn {
            background-color: #007bff; /* Blue */
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .reply-btn:hover {
            background-color: #0056b3; /* Darker blue */
        }

        .ignore-btn {
            background-color: #dc3545; /* Red */
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .ignore-btn:hover {
            background-color: #c82333; /* Darker red */
        }

        /* Reply form modal */
        #replyForm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, - 50%);
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            width: 400px;
            animation: slideIn 0.5s ease;
        }

        #replyForm h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }

        #replyForm textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            resize: none;
        }

        #replyForm button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: #66a6ff;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        #replyForm button:hover {
            background: #89f7fe;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translate(-50%, -60%) scale(0.8);
                opacity: 0;
            }
            to {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
        }

    </style>
</head>
<body>

<h1>Messages</h1>

<div class="container">
    <!-- Left side - Messages -->
    <div class="messages-container">
        <h3>Messages List</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
                $users = [];

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $users[$row['name']][] = $row; // Group messages by username
                }

                foreach ($users as $name => $messages) {
                    foreach ($messages as $message) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($message['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($message['message']) . "</td>";
                        echo "<td><button class='reply-btn' onclick='replyMessage(" . $message['id'] . ", \"" . htmlspecialchars($name) . "\")'>Reply</button> ";
                        echo "<button class='ignore-btn' onclick='ignoreMessage(" . $message['id'] . ")'>Ignore</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Right side - Buyer/Seller Communication -->
    <div class="communication-container">
        <img src="images/buyer.png" alt="Buyer" />
        <img src="images/conversation.png" alt="communication" />
        <img src="images/bookstore.png" alt="Seller" />
    </div>
</div>

<!-- Reply form modal -->
<div id="replyForm">
    <h3>Reply to <span id="replyTo"></span></h3>
    <textarea id="replyMessage" placeholder="Your Reply"></textarea>
    <button onclick="sendReply()">Send Reply</button>
</div>

<script>
function replyMessage(id, name) {
    document.getElementById('replyTo').textContent = name;
    document.getElementById('replyForm').style.display = 'block';
    document.getElementById('replyForm').setAttribute('data-id', id);
}

function ignoreMessage(id) {
    if (confirm('Are you sure you want to delete this message?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'delete_message.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Message deleted!');
                location.reload();
            }
        };
        xhr.send('id=' + encodeURIComponent(id));
    }
}

function sendReply() {
    const id = document.getElementById('replyForm').getAttribute('data-id');
    const message = document.getElementById('replyMessage').value;

    if (!message) {
        alert('Please enter your reply.');
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'reply_message.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Reply sent!');
            location.reload();
        }
    };
    xhr.send('id=' + encodeURIComponent(id) + '&message=' + encodeURIComponent(message));
}

</script>

</body>
</html>