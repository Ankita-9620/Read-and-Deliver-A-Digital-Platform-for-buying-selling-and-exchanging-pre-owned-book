<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Books</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Global styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;

            /* Background image */
            background-image: url('images/back3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }

        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
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

        /* Book list styles */
        .book-list {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px; /* Increased gap between books */
            margin: 20px;
            justify-items: center;
            margin-top: 120px; /* Gap after header */
        }

        .book-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
        }

        .book-item img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 5px;
        }

        .book-item h3 {
            font-size: 18px;
            color: #333;
        }

        .book-item p {
            font-size: 14px;
            color: #555;
        }

        .buy-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
            text-decoration: none;
        }

        .buy-btn:hover {
            background-color: #45a049;
        }

        /* Layout for smaller screens */
        @media (max-width: 768px) {
            .book-list {
                grid-template-columns: repeat(2, 1fr); /* Adjust to 2 columns */
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="nav-links">
            <a href="book.php">Available Books</a>
            <a href="browse.php">Book Store</a>
            <a href="categories.php">Categories</a>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Book list -->
    <div class="book-list">
        <!-- Book items -->
        <div class="book-item">
            <img src="images/book31.jpg" alt="Book 1">
            <h3>Book 1: JavaScript for Beginners</h3>
            <p>ISBN: 1234567890</p>
            <p>Author: John Doe</p>
            <a href="pay2.html?book_name=JavaScript for Beginners&book_price=29.99" class="buy-btn">Buy</a>
        </div>
        <div class="book-item">
            <img src="images/book32.jpg" alt="Book 2">
            <h3>Book 2: Learn HTML & CSS</h3>
            <p>ISBN: 2345678901</p>
            <p>Author: Jane Smith</p>
            <a href="pay2.html?book_name=Learn HTML & CSS&book_price=24.99" class="buy-btn">Buy</a>
        </div>
        <div class="book-item">
            <img src="images/book33.jpg" alt="Book 3">
            <h3>Book 3: PHP for Web Development</h3>
            <p>ISBN: 3456789012</p>
            <p>Author: William Brown</p>
            <a href="pay2.html?book_name=PHP for Web Development&book_price=34.99" class="buy-btn">Buy</a>
        </div>
        <div class="book-item">
            <img src="images/book34.jpg" alt="Book 4">
            <h3>Book 4: Python Programming</h3>
            <p>ISBN: 4567890123</p>
            <p>Author: Emily White</p>
            <a href="pay2.html?book_name=Python Programming&book_price=39.99" class="buy-btn">Buy</a>
        </div>
        <div class="book-item">
            <img src="images/book35.jpg" alt="Book 5">
            <h3>Book 5: Data Structures in C</h3>
            <p>ISBN: 5678901234</p>
            <p>Author: Michael Black</p>
            <a href="pay2.html?book_name=Data Structures in C&book_price=29.99" class="buy-btn">Buy</a>
        </div>
        <div class="book-item">
            <img src="images/book36.jpg" alt="Book 6">
            <h3>Book 6: Advanced JavaScript</h3>
            <p>ISBN: 6789012345</p>
            <p>Author: Jessica Green</p>
            <a href="pay2.html?book_name=Advanced JavaScript&book_price=34.99" class="buy-btn">Buy</a>
        </div>
        <div class="book-item">
            <img src="images/book37.jpg" alt="Book 7">
            <h3>Book 7: Mastering React</h3>
            <p>ISBN: 7890123456</p>
            <p>Author: Daniel Blue</p>
            <a href="pay2.html?book_name=Mastering React&book_price=44.99" class="buy-btn">Buy</a>
        </div>
        <div class="book-item">
            <img src="images/book38.jpg" alt="Book 8">
            <h3>Book 8: Introduction to Databases</h3>
            <p>ISBN: 8901234567</p>
            <p>Author: Olivia Red</p>
            <a href="pay2.html?book_name=Introduction to Databases&book_price=39.99" class="buy-btn">Buy</a>
        </div>
        <div class="book-item">
            <img src="images/book39.jpg" alt="Book 9">
            <h3>Book 9: Web Development Basics</h3>
            <p>ISBN: 9012345678</p>
            <p>Author: Nathan Yellow</p>
            <a href="pay2.html?book_name=Web Development Basics&book_price=29.99" class="buy-btn">Buy</a>
        </div>
        <div class="book-item">
            <img src="images/book40.jpg" alt="Book 10">
            <h3>Book 10: Algorithms in Python</h3>
            <p>ISBN: 1234098765</p>
            <p>Author: Sarah Pink</p>
            <a href="pay2.html?book_name=Algorithms in Python&book_price=34.99" class="buy-btn">Buy</a>
        </div>
    </div>
</body>
</html>
