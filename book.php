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

$sql = "SELECT * FROM inventory LIMIT 6"; // Fetch books from the inventory
$result = $conn->query($sql);

if (isset($_POST['add_to_wishlist'])) {
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session

    $wishlist_sql = "INSERT INTO wishlist (user_id, book_id) VALUES ('$user_id', '$book_id')";
    if ($conn->query($wishlist_sql) === TRUE) {
        echo "<script>alert('Book added to your wishlist!');</script>";
    } else {
        echo "<script>alert('Error adding book to wishlist.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
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

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .book-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 4 books per row */
            gap: 30px; /* Adjusted gap between books */
            margin-top: 30px;
            width: 80%; /* Center the content */
            animation: fadeIn 1s ease-in-out;
        }

        .book-item {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
        }

        .book-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .book-item img {
            width: 100px; /* Adjusted image size */
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .book-item img:hover {
            transform: scale(1.1);
        }

        .book-item h3 {
            font-size: 18px;
            color: #007BFF;
            margin-bottom: 8px;
        }

        .book-item p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 0; /* Remove gap between buttons */
        }

        .add-to-cart, .remove-btn {
            width: 50%; /* Same size for both buttons */
            padding: 8px 0;
            border: none;
            border-radius: 0 0 5px 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .add-to-cart {
            background-color: #28a745;
            color: white;
            border-radius: 0 0 0 5px;
        }

        .add-to-cart:hover {
            background-color: #218838;
        }

        .remove-btn {
            background-color: #218838;
            color: white;
            border-radius: 0 0 5px 0;
        }

        .remove-btn:hover {
            background-color: #bd2130;
        }

        .heart-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 36px; /* Increased the size */
            color: #ff4d4d;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .heart-icon:hover {
            transform: scale(1.2);
        }
        
        /* Your existing styles */
        .heart-icon {
            font-size: 36px; /* Increased heart icon size */
            color: #ff4d4d;
            cursor: pointer;
            transition: transform 0.3s;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .heart-icon:hover {
            transform: scale(1.2);
        }
        /* Your existing styles */
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

<h1>"Immediately Available Books"</h1>
<div class="book-list">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='book-item' style='position: relative;'>";
            echo "<span class='heart-icon' onclick='addToWishlist(" . $row['id'] . ")'>❤️</span>";
            echo "<img src='" . $row['image'] . "' alt='" . $row['title'] . "'>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>ISBN: " . $row['isbn'] . "</p>";
            echo "<p>Price: $" . $row['price'] . "</p>";
            echo "<p>Author: " . $row['author'] . "</p>";
            echo "<div class='button-container'>";
            echo "<form action='pay2.html' method='get' style='display:inline; width: 50%;'>";
            echo "<input type='hidden' name='book_name' value='" . $row['title'] . "'>";
            echo "<input type='hidden' name='book_price' value='" . $row['price'] . "'>";
            echo "<button type='submit' class='add-to-cart'>Buy</button>";
            echo "</form>";
            echo "<form action='remove_book.php' method='post' style='display:inline; width: 50%;'>";
            echo "<input type='hidden' name='book_id' value='" . $row['id'] . "'>";
            echo "<button type='submit' class='remove-btn'>Remove</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No books available.</p>";
    }
    ?>
</div>

<script>
    function addToWishlist(bookId) {
        const formData = new FormData();
        formData.append('book_id', bookId);
        formData.append('add_to_wishlist', true);

        fetch('book.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert('Book added to your wishlist!');
        })
        .catch(error => console.error('Error:', error));
    }
</script>

</body>
</html>

 ```php
<?php
$conn->close();
?>