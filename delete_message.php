<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = :id");
    $stmt->execute(['id' => $id]);

    echo "Message deleted successfully";
}
?>
