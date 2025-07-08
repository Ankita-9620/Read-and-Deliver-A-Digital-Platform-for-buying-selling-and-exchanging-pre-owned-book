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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $wishlist_id = $_POST['wishlist_id'];

    $sql = "DELETE FROM wishlist WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $wishlist_id);

    if ($stmt->execute()) {
        header("Location: wishlist.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
