<?php
// Start session
session_start();

// Database connection details
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

// Check if the book ID is passed via POST
if (isset($_POST['book_id'])) {
    $book_id = intval($_POST['book_id']); // Sanitize input to prevent SQL injection

    // Prepare the delete query
    $sql = "DELETE FROM inventory WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $book_id); // Bind the parameter
        if ($stmt->execute()) {
            echo "<script>
                alert('Book removed successfully.');
                window.location.href = 'book.php'; // Redirect to the book list page
            </script>";
        } else {
            echo "<script>
                alert('Error removing book. Please try again.');
                window.location.href = 'book.php'; // Redirect to the book list page
            </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
            alert('Failed to prepare query.');
            window.location.href = 'book.php'; // Redirect to the book list page
        </script>";
    }
} else {
    echo "<script>
        alert('Invalid request.');
        window.location.href = 'book.php'; // Redirect to the book list page
    </script>";
}

// Close the database connection
$conn->close();
?>
