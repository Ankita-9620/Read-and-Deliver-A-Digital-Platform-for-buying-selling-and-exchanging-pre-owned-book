<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'bookstore');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookName = $_POST['book_name'];
    $bookCondition = $_POST['book_condition'];

    // File upload logic
    $targetDir = "uploads/";
    $fileName = basename($_FILES["book_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    move_uploaded_file($_FILES["book_image"]["tmp_name"], $targetFilePath);

    // Insert into database with default status as 'Pending'
    $stmt = $conn->prepare("INSERT INTO book_exchange (book_name, book_condition, book_image, status) VALUES (?, ?, ?, 'Pending')");
    $stmt->bind_param("sss", $bookName, $bookCondition, $targetFilePath);
    $stmt->execute();
    $stmt->close();

    // Redirect to display.php after submission
    header("Location: display.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swap a Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
            background-color: #f9f9f9;
        }
        header {
            background: #007BFF;
            color: white;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        header h1 {
            margin: 0;
            font-size: 18px;
        }
        header .buttons {
            display: flex;
            gap: 10px;
        }
        header .buttons button {
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        header .back {
            background-color: #0056b3;
            color: white;
        }
        header .logout {
            background-color: #f44336;
            color: white;
        }
        header .view-status {
            background-color: #28a745;
            color: white;
        }
        header button:hover {
            opacity: 0.8;
            transform: scale(1.05);
            transition: 0.3s ease;
        }
        form {
            max-width: 500px;
            margin: 40px auto 0;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form h1 {
            text-align: center;
            color: #333;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Exchange Dashboard</h1>
        <div class="buttons">
            <button class="back" onclick="window.history.back()">Back</button>
            <button class="view-status" onclick="window.location.href='display.php'">Book Status</button>
            <button class="logout" onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </header>

    <form action="swap.php" method="POST" enctype="multipart/form-data">
        <h1>Enter the Book You Want to Exchange</h1>
        <label>Choose an Image</label>
        <input type="file" name="book_image" required>
        <label>Book Name or Title</label>
        <input type="text" name="book_name" required>
        <label>Book Condition</label>
        <select name="book_condition" required>
            <option value="Poor">Poor</option>
            <option value="Fair">Fair</option>
            <option value="Good">Good</option>
            <option value="Very Good">Very Good</option>
            <option value="Great">Great</option>
        </select>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
