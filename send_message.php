<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $message = $_POST['message'];

    $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
    $stmt->execute([$name, $message]);
    echo "Message sent!";
}
?>