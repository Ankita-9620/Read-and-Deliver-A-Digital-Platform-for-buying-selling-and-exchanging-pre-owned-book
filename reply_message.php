<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $reply = htmlspecialchars($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO messages (name, message) VALUES ((SELECT name FROM messages WHERE id = :id), :reply)");
    $stmt->execute(['id' => $id, 'reply' => $reply]);

    echo "Reply sent successfully";
}
?>
