<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $message = htmlspecialchars($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES (:name, :message)");
    $stmt->execute(['name' => $name, 'message' => $message]);

    header("Location: viewmsg.php");
    exit();
}
?>
