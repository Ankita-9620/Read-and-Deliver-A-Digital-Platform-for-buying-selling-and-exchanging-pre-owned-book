<?php
$host = 'localhost'; // Change if necessary
$db = 'bookstore';
$user = 'root'; // Change if necessary
$pass = ''; // Change if necessary

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>