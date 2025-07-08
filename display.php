<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'bookstore');

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    $delete_query = $conn->query("DELETE FROM book_exchange WHERE id = $delete_id");
    header("Location: ".$_SERVER['PHP_SELF']); // Refresh the page
    exit();
}

// Fetch all books entered by the user
$query = $conn->query("SELECT * FROM book_exchange ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .book-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .book-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 30%;
            max-width: 250px;
            text-align: center;
        }
        .book-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .book-card h3 {
            margin: 10px 0 5px;
            font-size: 18px;
            color: #333;
        }
        .book-card p {
            margin: 5px 0;
            font-size: 14px;
            color: #555;
        }
        .status {
            margin-top: 10px;
            font-weight: bold;
            color: orange;
        }
        .remove-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            font-size: 14px;
            color: #fff;
            background-color: #ff4d4d;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .remove-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; color: #333;">All Book Submissions</h1>
    <div class="book-container">
        <?php while ($book = $query->fetch_assoc()): ?>
            <div class="book-card">
                <img src="<?php echo $book['book_image']; ?>" alt="Book Image">
                <h3><?php echo $book['book_name']; ?></h3>
                <p><strong>Condition:</strong> <?php echo $book['book_condition']; ?></p>
                <p class="status">Status: <?php echo $book['status']; ?></p>
                <a href="?delete_id=<?php echo $book['id']; ?>" class="remove-btn" onclick="return confirm('Are you sure you want to remove this book?');">Remove</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
