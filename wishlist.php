<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id']; // Assuming user ID is stored in session
$sql = "SELECT b.*, w.id as wishlist_id FROM wishlist w JOIN inventory b ON w.book_id = b.id WHERE w.user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-image: url('images/back3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        .book-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 90px;
            padding: 20px;
            margin-top: 30px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .book-item {
            border: 2px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.9);
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: scale(1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .book-item:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .book-item img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header .nav-links {
            display: flex;
            gap: 20px;
        }

        .header .nav-links a {
            text-decoration: none;
            color: white;
            font-weight: bold;
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
            color: whitesmoke;
            margin-top: 70px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .buy-btn, .remove-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        .buy-btn:hover, .remove-btn:hover {
            background-color: #218838;
            transform: scale(1.1);
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
</head>
<body>
<div class="header">
    <div class="nav-links">
        <a href="book.php">Available Books</a>
        <a href="browse.php">Book Store</a>
        <a href="categories.php">Categories</a>
        <a href="wishlist.php">Wishlist</a>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<h1>Your Wishlist</h1>
<div class="book-list">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='book-item'>";
            echo "<img src='" . $row['image'] . "' alt='" . $row['title'] . "'>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>ISBN: " . $row['isbn'] . "</p>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "<p>Author: " . $row['author'] . "</p>";
            echo "<div class='button-container'>";
            echo "<button class='buy-btn' onclick=\"window.location.href='pay2.html'\">Buy Now</button>";
            echo "<form action='remove_from_wishlist.php' method='POST' style='display: inline;'>";
            echo "<input type='hidden' name='wishlist_id' value='" . $row['wishlist_id'] . "'>";
            echo "<button type='submit' class='remove-btn'>Remove</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Your wishlist is empty.</p>";
    }
    ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
