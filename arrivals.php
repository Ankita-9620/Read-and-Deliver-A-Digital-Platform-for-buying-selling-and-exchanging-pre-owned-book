<?php
session_start();
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "bookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch new arrivals from the database
$sql = "SELECT * FROM new_arrivals LIMIT 18";  // Limit to 18 books for 3 containers (6 per container)
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Arrivals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f8ff;
        }
        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
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
        h1 {
            color: #333;
            margin-top: 70px;
            text-align: center;
        }
        .video-container {
            text-align: center;
            margin-bottom: 30px;
        }
        .book-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .book-item {
            width: 30%;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .book-item img {
            width: 300px;
            height: 500px; /* Increased height */
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .book-item h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 8px;
        }
        .book-item p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }
        .buy-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .buy-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="nav-links">
        <a href="add_books.php">Add Books</a>
        <a href="arrivals.php">New Arrivals</a>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<h1>New Arrivals</h1>

<div class="video-container">
    <video width="80%" autoplay loop muted>
        <source src="videos/book.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<?php
if ($result->num_rows > 0) {
    // Fetch all books into an array
    $books = [];
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    // Split into 3 containers (each with 6 books)
    for ($i = 0; $i < 3; $i++) {
        echo '<div class="book-container">';
        for ($j = 0; $j < 6; $j++) {
            // Check if the book exists
            if (isset($books[$i * 6 + $j])) {
                $book = $books[$i * 6 + $j];
                // Ensure that the book image exists or use a placeholder
                $bookImage = !empty($book['image']) ? $book['image'] : 'default.jpg';
                echo "<div class='book-item'>";
                echo "<img src='" . $bookImage . "' alt='" . $book['title'] . "'>";
                echo "<h3>" . $book['title'] . "</h3>";
                echo "<p>ISBN: " . $book['isbn'] . "</p>";
                echo "<p>Author: " . $book['author'] . "</p>";
                echo "<p>Price: $" . number_format($book['price'], 2) . "</p>";
                echo "<form action='payment.php' method='post'>";
                echo "<input type='hidden' name='title' value='" . $book['title'] . "'>";
                echo "<input type='hidden' name='isbn' value='" . $book['isbn'] . "'>";
                echo "<input type='hidden' name='author' value='" . $book['author'] . "'>";
                echo "<input type='hidden' name='price' value='" . $book['price'] . "'>";
                echo "</form>";
                echo "</div>";
            }
        }
        echo '</div>';
    }
} else {
    echo "<p>No new arrivals available.</p>";
}
?>

</body>
</html>

<?php
$conn->close();
?>
