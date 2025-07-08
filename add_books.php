<?php
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "bookstore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $isbn = $conn->real_escape_string($_POST['isbn']);
    $author = $conn->real_escape_string($_POST['author']);
    $price = $conn->real_escape_string($_POST['price']);
    $book_condition = $conn->real_escape_string($_POST['book_condition']);
    $actual_price = $conn->real_escape_string($_POST['actual_price']);
    
    // Handle file upload
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO inventory (title, isbn, author, price, image, book_condition, actual_price) 
                VALUES ('$title', '$isbn', '$author', '$price', '$target', '$book_condition', '$actual_price')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New book added successfully.');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Books</title>
    <style>
                body {
            font-family: Arial, sans-serif;
            background-image: url('images/back3.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
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
        .container {
            max-width: 1000px; /* Increased width */
            margin: 120px auto; /* Center the container */
            padding: 30px; /* Increased padding */
            background-color: rgba(255, 255, 255, 0.9); /* White background with transparency */
            border-radius: 10px; /* Increased border radius */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* More pronounced shadow */
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            margin-top: 10px;
            display: block;
        }
        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="file"]:focus, select:focus {
            border-color: #007BFF;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }

    </style>
    <script>
        function updatePrice() {
            var actualPrice = parseFloat(document.getElementById("actual_price").value);
            var priceInput = document.getElementById("price");

            if (actualPrice >= 50 && actualPrice <= 150) {
                priceInput.value = actualPrice + 20;
            } else if (actualPrice > 150 && actualPrice <= 250) {
                priceInput.value = actualPrice + 30;
            } else if (actualPrice > 250 && actualPrice <= 350) {
                priceInput.value = actualPrice + 40;
            } else {
                priceInput.value = "";
            }
        }
    </script>
</head>
<body>

<div class="header">
    <div class="nav-links">
        <a href="add_books.php">Add Books</a>
        <a href="arrivals.php">New Arrivals</a>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="container">
    <h1>Add a New Book</h1>
    <form action="add_books.php" method="post" enctype="multipart/form-data">
        <label for="title">Book Title:</label>
        <input type="text" name="title" required>
        
        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" required>
        
        <label for="author">Author Name:</label>
        <input type="text" name="author" required>
        
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" readonly required>
        
        <label for="book_condition">Book Condition:</label>
        <select name="book_condition" id="book_condition" required>
            <option value="poor">Poor</option>
            <option value="good">Good</option>
            <option value="very_good">Very Good</option>
        </select>
        
        <label for="actual_price">Actual Book Price:</label>
        <input type="text" id="actual_price" name="actual_price" oninput="updatePrice()" required>
        
        <label for="image">Choose Image:</label>
        <input type="file" name="image" required>
        
        <button type="submit">Add Book</button>
    </form>
</div>

</body>
</html>

<?php
$conn->close();
?>