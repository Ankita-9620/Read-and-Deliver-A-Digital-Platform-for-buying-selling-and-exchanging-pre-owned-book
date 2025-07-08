<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messaging App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f9 url('images/images.jpg') no-repeat center center;
            background-size: cover; /* Ensures the image covers the entire background */
        }

        header {
            background: rgba(102, 166, 255, 0.9); /* Add slight transparency for better readability */
            color: #fff;
            padding: 15px 30px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .container {
            display: flex;
            justify-content: flex-start; /* Align items closer together */
            align-items: center;
            height: calc(100vh - 60px);
            padding: 0 40px;
            gap: 20px;
            margin-right: 230px;
        }

        .quote-section {
            flex: 1;
            text-align: left;
            padding: 20px;
            font-size: 20px;
            color: white;
            line-height: 1.5;
            margin-left: 130px;
        }

        .quote-section span {
            font-size: 24px;
            font-weight: bold;
            color: whitesmoke;
        }

        .message-form {
            background: #ffffff;
            border-radius: 15px;
            padding: 25px 20px;
            width: 350px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .message-form:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
        }

        .message-form h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 26px;
            font-weight: bold;
        }

        .message-form input, 
        .message-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background: #f9f9f9;
            outline: none;
            transition: border-color 0.3s ease, background 0.3s ease;
        }

        .message-form input:focus, 
        .message-form textarea:focus {
            border-color: #66a6ff;
            background: #ffffff;
        }

        .message-form button {
            background: linear-gradient(120deg, #66a6ff, #89f7fe);
            color: #ffffff;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(102, 166, 255, 0.3);
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .message-form button:hover {
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
            transform: translateY(-3px);
        }

        .message-form button:active {
            transform: translateY(1px);
        }
    </style>
</head>
<body>

<header>
    Messaging App - Communication Between Buyers and Sellers
</header>

<div class="container">
    <div class="quote-section">
        <p>
            <span>"Effective Communication"</span> is the bridge between <br> the seller's knowledge 
            and the buyer's needs. <br><br> 
            <em>Let's make it seamless!</em>
        </p>
    </div>
    <div class="message-form">
        <h2>Send a Message</h2>
        <form action="save_message.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <textarea name="message" placeholder="Your Message" rows="4" required></textarea>
            <button type="submit">Send</button>
        </form>

    </div>
</div>

<script>
    function sendMessage() {
        const userName = document.getElementById('userName').value;
        const userMessage = document.getElementById('userMessage').value;

        if (!userName || !userMessage) {
            alert('Please fill in both fields!');
            return;
        }

        // Simulate sending the message
        alert(`Message sent!\n\nName: ${userName}\nMessage: ${userMessage}`);

        // Clear the fields
        document.getElementById('userName').value = '';
        document.getElementById('userMessage').value = '';
    }
</script>

</body>
</html>
