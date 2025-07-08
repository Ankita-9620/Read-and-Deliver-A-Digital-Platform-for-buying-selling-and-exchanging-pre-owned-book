<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/back3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9); /* Slightly transparent white background */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        .feedback-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }
        .feedback-item img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .feedback-item div {
            max-width: 600px;
        }
        .feedback-item h3 {
            margin: 0;
            color: #333;
        }
        .feedback-item p {
            margin: 5px 0;
            color: #666;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px 20px;
            background-color: rgba(0, 123, 255, 0.8); /* Slightly transparent blue */
            color: white;
        }
        .header .nav-links {
            display: flex;
            gap: 20px;
        }
        .header .nav-links a {
            text-decoration: none;
            color: white;
            transition: color 0.3s;
        }
        .header .nav-links a:hover {
            color: #ddd;
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
            transition: background-color 0.3s;
        }
        .logout-btn:hover {
            background-color: #d93636;
        }
    </style>
</head>

<div class="header">
    <div class="nav-links">
        <a href="add_books.php">Add Books</a>
        <a href="arrivals.php">New Arrivals</a>
        <a href="viewmsg.php">View Messages</a>
        <a href="viewfeedback.php">View Feedback</a>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<body>
    <div class="container">
        <h2>All Feedback</h2>
        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'bookstore');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM feedback ORDER BY id DESC");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='feedback-item'>
                    <img src='" . htmlspecialchars($row['image']) . "' alt='User Image'>
                    <div>
                        <h3>" . htmlspecialchars($row['username']) . "</h3>
                        <p><strong>Book Name:</strong> " . htmlspecialchars($row['bookname']) . "</p>
                        <p><strong>Message:</strong> " . htmlspecialchars($row['message']) . "</p>
                    </div>
                </div>";
            }
        } else {
            echo "<p style='text-align:center;'>No feedback available.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
