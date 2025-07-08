<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'bookstore');

// Get book ID from URL
if (isset($_GET['book_id'])) {
    $book_id = (int)$_GET['book_id'];
    $result = $conn->query("SELECT * FROM book_exchange WHERE id = $book_id");
    $book = $result->fetch_assoc();
} else {
    echo "<script>alert('No book selected!'); window.location.href = 'exchange.php';</script>";
    exit();
}

// Handle location submission
if (isset($_POST['confirm'])) {
    $user_name = $_POST['user_name'];
    $village_name = $_POST['village_name'];
    $district_name = $_POST['district_name'];
    $taluku_name = $_POST['taluku_name'];
    $pin_code = $_POST['pin_code'];

    // Store user data in the session to pass it to track.php
    session_start();
    $_SESSION['book_details'] = $book;
    $_SESSION['user_details'] = [
        'user_name' => $user_name,
        'village_name' => $village_name,
        'district_name' => $district_name,
        'taluku_name' => $taluku_name,
        'pin_code' => $pin_code,
    ];

    echo "<script>window.location.href = 'track.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Location</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .form-container {
            max-width: 400px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .form-container input, .form-container button {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .form-container button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Confirm Book Location</h1>
        <p>"A book exchanged is a story shared."</p>
    </header>

    <div class="form-container">
        <img src="<?php echo $book['book_image']; ?>" alt="Book Image">
        <p><strong>Book Name:</strong> <?php echo htmlspecialchars($book['book_name']); ?></p>
        <p><strong>Condition:</strong> <?php echo htmlspecialchars($book['book_condition']); ?></p>
        <form method="POST">
            <input type="text" name="user_name" placeholder="Your Name" required>
            <input type="text" name="village_name" placeholder="Village Name" required>
            <input type="text" name="district_name" placeholder="District Name" required>
            <input type="text" name="taluku_name" placeholder="Taluku Name" required>
            <input type="text" name="pin_code" placeholder="Pin Code" required>
            <button type="submit" name="confirm">Confirm Your Book</button>
        </form>
    </div>
</body>
</html>
