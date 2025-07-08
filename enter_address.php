<?php
session_start();

// Check if the form is submitted
$popup_message = ""; // Default empty popup message
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $emergency_contact = htmlspecialchars($_POST['emergency_contact']);
    $address = htmlspecialchars($_POST['address']);

    // Simple validation for demonstration purposes
    if (empty($name) || empty($contact_number) || empty($address)) {
        $error_message = "Please fill all required fields.";
    } else {
        // Generate random days between 1 and 10
        $delivery_days = rand(1, 10);
        $popup_message = "Congratulations! Your books will be delivered within $delivery_days days.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Address</title>
    <style>
        /* General Reset */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fa;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        /* Right Section (Form) */
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 45%;
            animation: slideInRight 1s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }

        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        form input:focus, form textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        /* Left Section (Quote) */
        .quote-container {
            background: #007bff;
            color: #fff;
            width: 45%;
            height: 80vh; /* Increased height */
            padding: 50px 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: slideInLeft 1s ease-in-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .quote-container h3 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .quote-container p {
            font-size: 20px;
            font-style: italic;
            line-height: 1.6;
        }

        /* Popup Message */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            color: #333;
            border: 2px solid #007bff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
            z-index: 1000;
            font-size: 20px;
            animation: fadeIn 0.5s ease-in-out;
        }

        .popup button {
            margin-top: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup button:hover {
            background-color: #0056b3;
        }

        /* Animations */
        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
    <script>
        function showPopup(message) {
            const popup = document.getElementById('popup');
            const popupMessage = document.getElementById('popup-message');
            popupMessage.textContent = message;
            popup.style.display = 'block';
        }

        function closePopup() {
            const popup = document.getElementById('popup');
            popup.style.display = 'none';
        }

        // Automatically show popup if a message exists
        window.onload = function() {
            const message = "<?php echo $popup_message; ?>";
            if (message) {
                showPopup(message);
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <!-- Quote Section -->
        <div class="quote-container">
            <h3>Quote of the Day</h3>
            <p>"Books are the treasured wealth of the world and the fit inheritance of generations and nations." - Henry David Thoreau</p>
        </div>

        <!-- Form Section -->
        <div class="form-container">
            <h2>Enter Your Address</h2>
            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" placeholder="Enter your name" required>

                <label for="contact_number">Contact Number:</label>
                <input type="text" name="contact_number" id="contact_number" placeholder="Enter your contact number" required>

                <label for="emergency_contact">Emergency Contact Number:</label>
                <input type="text" name="emergency_contact" id="emergency_contact" placeholder="Enter your emergency contact number">

                <label for="address">Address (200 words max):</label>
                <textarea name="address" id="address" rows="5" maxlength="200" placeholder="Enter your address..." required></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <!-- Popup Message -->
    <div class="popup" id="popup">
        <div id="popup-message"></div>
        <button onclick="closePopup()">OK</button>
    </div>
</body>
</html>
