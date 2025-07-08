<?php
// login.php

// Start session
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'bookstore');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = '';

// Login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (empty($email) || empty($password)) {
        $error = 'Please enter both email and password.';
    } else {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();
            
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $user_id;
                header("Location: index.html");
                exit();
            } else {
                $error = 'Invalid password. Please try again.';
            }
        } else {
            $error = 'No account found with that email.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<style>
    /* Background and Layout */
    body {
        font-family: Arial, sans-serif;
        background-image: url('images/back.jpg'); /* Replace 'images/back.jpg' with your actual image path */
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100vh;
        padding: 0 5%;
        color: #fff;
    }

    /* Left Side Title and Welcome Message */
    .left-content {
        max-width: 45%;
        animation: slideIn 1.2s ease-in-out;
        margin-bottom: 150px;
    }

    .left-content h1 {
        font-size: 42px;
        font-weight: bold;
        line-height: 1.2;
        color: #ffe06c;
        margin-bottom: 20px;
    }

    .left-content p {
        font-size: 20px;
        color: #fffae3;
    }

    /* Animation for Left Content */
    @keyframes slideIn {
        0% { opacity: 0; transform: translateX(-50px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    /* Login Container on the Right */
    .container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        animation: fadeIn 1.2s ease-in-out;
        background-color: rgba(255, 255, 255, 0.85); /* Slight transparency */
        margin-bottom: 150px; /* Add margin-top to move the container up */
    }

    /* Animation for Login Container */
    @keyframes fadeIn {
        0% { opacity: 0; transform: translateX(50px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    /* Form Styles */
    h2 { 
        text-align: center; 
        color: #333; 
    }

    form { 
        display: flex; 
        flex-direction: column; 
    }

    input[type="email"], input[type="password"] {
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    button {
        padding: 10px;
        border: none;
        background: #4CAF50;
        color: #fff;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 10px;
    }

    button:hover {
        background: #45a049;
    }

    /* Error Message */
    .error {
        color: red;
        text-align: center;
    }

    /* Link to Register */
    .register-link {
        text-align: center;
        color: #333;
        font-size: 14px;
        margin-top: 10px;
    }

    .register-link a {
        color: #4CAF50;
        text-decoration: none;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 10px 20px;
        z-index: 10;
    }

    .header a {
        text-decoration: none;
        color: #000;
        margin-right: 50px; /* Increased space between links */
        font-size: 20px; /* Increased font size */
        font-weight: bold;
        margin-top: 15px;
    }

    .header a:hover {
        color: #007BFF;
    }

</style>
</head>
<body>

<div class="header">
    <a href="about.html">About Us</a>
    <a href="contact.html">Contact Us</a>
    <a href="services.html">Services</a>
</div>

<!-- Left Side with Title and Welcome Message -->
<div class="left-content">
    <h1>The Digital Platform for Exchange Of Pre-owned Books</h1>
    <p>Welcome back! Please log in to continue your journey with us.</p>
</div>

<!-- Login Form Container on the Right -->
<div class="container">
    <h2>Login</h2>
    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
    </form>
</div>

</body>
</html>