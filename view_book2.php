<?php
include 'db2.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: exchange_login.php");
    exit();
}

if (isset($_GET['book_id'])) {
    $book_id = mysqli_real_escape_string($conn, $_GET['book_id']);

    // Fetch book details along with uploader information
    $sql = "SELECT books.book_name, books.book_image, books.book_condition, books.author_name, users.username AS uploader_name 
            FROM books 
            INNER JOIN users ON books.user_id = users.id 
            WHERE books.id = '$book_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
    } else {
        die("Book not found.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        /* Header Styles */
        .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #007bff;
    padding: 20px 20px; /* Increased padding for height */
    height: 40px; /* Explicitly set a taller height */
    color: #fff;
}

        .header .left-buttons a,
        .header .right-title {
            font-size: 18px;
            text-decoration: none;
            color: #fff;
        }

        .header .left-buttons a {
            margin-right: 15px;
            padding: 8px 12px;
            background-color: #0056b3;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .header .left-buttons a:hover {
            background-color: #004085;
        }
        
        .header .right-title {
            font-size: 40px;
            text-decoration: none;
            color: #fff;
            margin-right: 60px;
        }



        /* Container Styles */
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        h2 {
            color: #333;
        }

        p {
            font-size: 16px;
            color: #666;
            margin: 10px 0;
        }

        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <div class="left-buttons">
            <a href="notifications.php">Back to Notifications</a>
            <a href="enter_address.php">Enter Address</a>
        </div>
        <div class="right-title">
            <span>View Books</span>
        </div>
    </div>

    <!-- Book Details Container -->
    <div class="container">
        <h2>Book Details</h2>
        <img src="<?php echo htmlspecialchars($book['book_image']); ?>" alt="Book Image">
        <p><strong>Book Name:</strong> <?php echo htmlspecialchars($book['book_name']); ?></p>
        <p><strong>Condition:</strong> <?php echo htmlspecialchars($book['book_condition']); ?></p>
        <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author_name']); ?></p>
        <p><strong>Uploaded by:</strong> <?php echo htmlspecialchars($book['uploader_name']); ?></p>
    </div>
</body>
</html>
