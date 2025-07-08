<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/back3.jpg'); /* Replace with your background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #333;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .container h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input, textarea, button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }

        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px 20px;
            background: linear-gradient(90deg, #007BFF, #0056b3);
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            0% { transform: translateY(-100%); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .header .nav-links {
            display: flex;
            gap: 20px;
        }

        .header .nav-links a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s, transform 0.3s;
        }

        .header .nav-links a:hover {
            color: #ffcccb;
            transform: scale(1.1);
        }

        .logout-btn {
            background-color: #ff4d4d;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        .logout-btn:hover {
            background-color: #d93636;
            transform: scale(1.1);
        }
    </style>
</head>

<div class="header">
    <div class="nav-links">
        <a href="book.php">Available Books</a>
        <a href="browse.php">Book Store</a>
        <a href="categories.php">Categories</a>
        <a href="feedback.php">Feedback</a>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<body>
    <div class="container">
        <h2>Submit Your Feedback</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="image">User Image:</label>
            <input type="file" name="image" id="image" required>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <label for="bookname">Book Name:</label>
            <input type="text" name="bookname" id="bookname" required>
            <label for="message">Message (max 300 words):</label>
            <textarea name="message" id="message" rows="5" maxlength="300" required></textarea>
            <button type="submit" name="submit">Submit Feedback</button>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $bookname = $_POST['bookname'];
        $message = $_POST['message'];

        // File upload logic
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);

        // Ensure the uploads directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'bookstore');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("INSERT INTO feedback (username, bookname, message, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $bookname, $message, $target_file);

            if ($stmt->execute()) {
                echo "<p style='text-align:center;color:green;'>Feedback submitted successfully!</p>";
            } else {
                echo "<p style='text-align:center;color:red;'>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<p style='text-align:center;color:red;'>Failed to upload image.</p>";
        }
    }
    ?>
</body>
</html>
