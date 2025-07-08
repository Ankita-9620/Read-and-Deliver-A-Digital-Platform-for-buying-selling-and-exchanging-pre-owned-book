<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore - Browse Books</title>
    <style>
        /* General styles for the body */
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;

    /* Correct background image */
    background-image: url('images/back3.jpg');
    background-size: cover; /* Ensures the image covers the entire background */
    background-repeat: no-repeat; /* Prevents repetition of the background image */
    background-position: center; /* Centers the image */
    background-attachment: fixed; /* Ensures the background stays fixed during scroll */
}

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Header styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 10px 20px;
            background: linear-gradient(90deg, #007BFF, #0056b3);
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            animation: slideIn 1s ease-out;
        }

        @keyframes slideIn {
            0% { transform: translateY(-100%); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .header .nav-links {
            display: flex;
            gap: 20px;
        }

        .header .nav-links a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s, transform 0.3s;
        }

        .header .nav-links a:hover {
            color: #ffcccb;
            transform: scale(1.1);
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
            transition: background-color 0.3s, transform 0.3s;
        }

        .logout-btn:hover {
            background-color: #d93636;
            transform: scale(1.1);
        }

        /* Search bar styles */
        .search-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .search-container select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .search-container button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-container button:hover {
            background-color: #0056b3;
        }

        /* Content section */
        .content {
            margin-top: 20px;
            text-align: center;
            color: white;
        }

        .content h1 {
            font-size: 40px;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
            margin-bottom: 20px;
            animation: fadeInDown 1.5s ease-in-out;
        }

        .content p {
            font-size: 18px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1.5s ease-in-out;
        }

        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* Book list section */
        .book-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 30px;
            width: 90%;
            max-width: 900px;
            padding: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        .book-item {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            background-color: #f9f9f9;
            box-shadow: 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            animation: popUp 0.8s ease-in-out;
            position: relative;
        }

        @keyframes popUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .book-item:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .book-item img {
            width: 100px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .book-item img:hover {
            transform: scale(1.1);
        }

        .book-item h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 8px;
        }

        .book-item p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .buy-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
            margin-bottom: 30px;
            position: absolute;
            right: 0;
            bottom: 0;
        }

        .buy-btn:hover {
            background-color: #45a049;
        }

        /* Section headers */
        .section-header {
            margin-top: 50px;
            font-size: 30px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header">
        <div class="nav-links">
            <a href="book.php">Available Books</a>
            <a href="browse.php">Browse Books</a>
            <a href="categories.php">Categories</a>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <div class="search-container">
        <select id="categorySelect">
            <option value="">Select Category</option>
            <option value="story">Story Books</option>
            <option value="educational">Educational Books</option>
            <option value="drama">Drama Books</option>
            <option value="poetry">Poetry Books</option>
            <option value="finance">Finance Books</option>
        </select>
        <button type="button" onclick="filterBooks()">Search</button>
    </div>

    <!-- Book List Section -->
    <div class="book-list" id="bookList">
        <!-- Story Books -->
        <div class="book-item story" style="display:none;">
            <img src="images/book1.jpg" alt="Book 1">
            <h3>The Great Adventure</h3>
            <p>Author: John Taine</p>
            <p>ISBN: 7891237319</p>
            <a href="pay2.html?book_name=The%20Great%20Adventure&book_price=10" class="buy-btn">Buy</a>
        </div>
        <div class="book-item story" style="display:none;">
            <img src="images/book2.jpg" alt="Book 2">
            <h3>A Journey Through Time</h3>
            <p>Author: H.G. Wells</p>
            <p>ISBN: 0987654321</p>
            <a href="pay2.html?book_name=A%20Journey%20Through%20Time&book_price=15" class="buy-btn">Buy</a>
        </div>
        <div class="book-item story" style="display:none;">
            <img src="images/book3.jpg" alt ="Book 3">
            <h3>Will Wight</h3>
            <p>Author: Will Wight</p>
            <p>ISBN: 1122334455</p>
            <a href="pay2.html?book_name=Will%20Wight&book_price=12" class="buy-btn">Buy</a>
        </div>
        <div class="book-item story" style="display:none;">
            <img src="images/book4.jpg" alt="Book 4">
            <h3>Lost in the Wild</h3>
            <p>Author: Sarah Blake</p>
            <p>ISBN: 2233445566</p>
            <a href="pay2.html?book_name=Lost%20in%20the%20Wild&book_price=14" class="buy-btn">Buy</a>
        </div>
        <div class="book-item story" style="display:none;">
            <img src="images/book5.jpg" alt="Book 5">
            <h3>The Secret of the Island</h3>
            <p>Author: Emily Roberts</p>
            <p>ISBN: 6677889900</p>
            <a href="pay2.html?book_name=The%20Secret%20of%20the%20Island&book_price=16" class="buy-btn">Buy</a>
        </div>
        <div class="book-item story" style="display:none;">
            <img src="images/book6.jpg" alt="Book 6">
            <h3>The Last Expedition</h3>
            <p>Author: James Harrison</p>
            <p>ISBN: 3344556677</p>
            <a href="pay2.html?book_name=The%20Last%20Expedition&book_price=18" class="buy-btn">Buy</a>
        </div>

        <!-- Educational Books -->
        <div class="book-item educational" style="display:none;">
            <img src="images/book7.jpg" alt="Book 7">
            <h3>Introduction to AI</h3>
            <p>Author: Dr. Anna Smith</p>
            <p>ISBN: 1112131415</p>
            <a href="pay2.html?book_name=Introduction%20to%20AI&book_price=20" class="buy-btn">Buy</a>
        </div>
        <div class="book-item educational" style="display:none;">
            <img src="images/book8.jpg" alt="Book 8">
            <h3>Mathematics for Beginners</h3>
            <p>Author: Michael Faraday</p>
            <p>ISBN: 1122334455</p>
            <a href="pay2.html?book_name=Mathematics%20for%20Beginners&book_price=22" class="buy-btn">Buy</a>
        </div>
        <div class="book-item educational" style="display:none;">
            <img src="images/book9.jpg" alt="Book 9">
            <h3>Physics Essentials</h3>
            <p>Author: Isaac Newton</p>
            <p>ISBN: 2233445566</p>
            <a href="pay2.html?book_name=Physics%20Essentials&book_price=25" class="buy-btn">Buy</a>
        </div>
        <div class="book-item educational" style="display:none;">
            <img src="images/book10.jpg" alt="Book 10">
            <h3>Programming 101</h3>
            <p>Author: Alan Turing</p>
            <p>ISBN: 5566778899</p>
            <a href="pay2.html?book_name=Programming%20101&book_price=30" class="buy-btn">Buy</a>
        </div>
        <div class="book-item educational" style="display:none;">
            <img src="images/book11.jpg" alt="Book 11">
            <h3>Advanced Calculus</h3>
            <p>Author: Pierre-Simon Laplace</p>
            <p>ISBN: 9988776655</p>
            <a href="pay2.html?book_name=Advanced%20Calculus&book_price=28" class="buy-btn">Buy</a>
        </div>
        <div class="book-item educational" style="display:none;">
            <img src="images/book12.jpg" alt="Book 12">
            <h3>Artificial Intelligence: A New Era</h3>
            <p>Author: Alan Turing</p>
            <p> ISBN: 6677889900</p>
            <a href="pay2.html?book_name=Artificial%20Intelligence:%20A%20New%20Era&book_price=35" class="buy-btn">Buy</a>
        </div>

        <!-- Drama Books -->
        <div class="book-item drama" style="display:none;">
            <img src="images/book13.jpg" alt="Book 13">
            <h3>The Tragedy of Hamlet</h3>
            <p>Author: William Shakespeare</p>
            <p>ISBN: 1010101010</p>
            <a href="pay2.html?book_name=The%20Tragedy%20of%20Hamlet&book_price=12" class="buy-btn">Buy</a>
        </div>
        <div class="book-item drama" style="display:none;">
            <img src="images/book14.jpg" alt="Book 14">
            <h3>A Midsummer Night's Dream</h3>
            <p>Author: William Shakespeare</p>
            <p>ISBN: 2020202020</p>
            <a href="pay2.html?book_name=A%20Midsummer%20Night's%20Dream&book_price=15" class="buy-btn">Buy</a>
        </div>
        <div class="book-item drama" style="display:none;">
            <img src="images/book15.jpg" alt="Book 15">
            <h3>The Glass Menagerie</h3>
            <p>Author: Tennessee Williams</p>
            <p>ISBN: 3030303030</p>
            <a href="pay2.html?book_name=The%20Glass%20Menagerie&book_price=18" class="buy-btn">Buy</a>
        </div>
        <div class="book-item drama" style="display:none;">
            <img src="images/book16.jpg" alt="Book 16">
            <h3>Death of a Salesman</h3>
            <p>Author: Arthur Miller</p>
            <p>ISBN: 4040404040</p>
            <a href="pay2.html?book_name=Death%20of%20a%20Salesman&book_price=20" class="buy-btn">Buy</a>
        </div>
        <div class="book-item drama" style="display:none;">
            <img src="images/book17.jpg" alt="Book 17">
            <h3>The Crucible</h3>
            <p>Author: Arthur Miller</p>
            <p>ISBN: 5050505050</p>
            <a href="pay2.html?book_name=The%20Crucible&book_price=22" class="buy-btn">Buy</a>
        </div>
        <div class="book-item drama" style="display:none;">
            <img src="images/book18.jpg" alt="Book 18">
            <h3>Waiting for Godot</h3>
            <p>Author: Samuel Beckett</p>
            <p>ISBN: 6060606060</p>
            <a href="pay2.html?book_name=Waiting%20for%20Godot&book_price=25" class="buy-btn">Buy</a>
        </div>

        <!-- Poetry Books -->
        <div class="book-item poetry" style="display:none;">
            <img src="images/book19.jpg" alt="Book 19">
            <h3>The Raven</h3>
            <p>Author: Edgar Allan Poe</p>
            <p>ISBN: 7070707070</p>
            <a href="pay2.html?book_name=The%20Raven&book_price=10" class="buy-btn">Buy</a>
        </div>
        <div class="book-item poetry" style="display:none;">
            <img src="images/book20.jpg" alt="Book 20">
            <h3>Leaves of Grass</h3>
            <p>Author: Walt Whitman</p>
            <p>ISBN: 8080808080</p>
            <a href="pay2.html?book_name=Leaves%20of%20Grass&book_price=12" class="buy-btn">Buy</a>
        </div>
        <div class="book-item poetry" style="display:none;">
            <img src="images/book21.jpg" alt="Book 21">
            <h3>Divine Comedy</h3>
            <p>Author: Dante Alighieri</p>
            <p>ISBN: 9090909090</p>
            <a href ="pay2.html?book_name=Divine%20Comedy&book_price=15" class="buy-btn">Buy</a>
        </div>
        <div class="book-item poetry" style="display:none;">
            <img src="images/book22.jpg" alt="Book 22">
            <h3>The Iliad</h3>
            <p>Author: Homer</p>
            <p>ISBN: 1010101011</p>
            <a href="pay2.html?book_name=The%20Iliad&book_price=18" class="buy-btn">Buy</a>
        </div>
        <div class="book-item poetry" style="display:none;">
            <img src="images/book23.jpg" alt="Book 23">
            <h3>Odes</h3>
            <p>Author: Horace</p>
            <p>ISBN: 2020202021</p>
            <a href="pay2.html?book_name=Odes&book_price=20" class="buy-btn">Buy</a>
        </div>
        <div class="book-item poetry" style="display:none;">
            <img src="images/book24.jpg" alt="Book 24">
            <h3>Poems</h3>
            <p>Author: Emily Dickinson</p>
            <p>ISBN: 3030303031</p>
            <a href="pay2.html?book_name=Poems&book_price=22" class="buy-btn">Buy</a>
        </div>

        <!-- Finance Books -->
        <div class="book-item finance" style="display:none;">
            <img src="images/book25.jpg" alt="Book 25">
            <h3>Rich Dad Poor Dad</h3>
            <p>Author: Robert Kiyosaki</p>
            <p>ISBN: 4040404041</p>
            <a href="pay2.html?book_name=Rich%20Dad%20Poor%20Dad&book_price=10" class="buy-btn">Buy</a>
        </div>
        <div class="book-item finance" style="display:none;">
            <img src="images/book26.png" alt="Book 26">
            <h3>The Intelligent Investor</h3>
            <p>Author: Benjamin Graham</p>
            <p>ISBN: 5050505051</p>
            <a href="pay2.html?book_name=The%20Intelligent%20Investor&book_price=15" class="buy-btn">Buy</a>
        </div>
        <div class="book-item finance" style="display:none;">
            <img src="images/book27.jpg" alt="Book 27">
            <h3>The Little Book of Common Sense Investing</h3>
            <p>Author: John C. Bogle</p>
            <p>ISBN: 6060606061</p>
            <a href="pay2.html?book_name=The%20Little%20Book%20of%20Common%20Sense%20Investing&book_price=20" class="buy-btn">Buy</a>
        </div>
        <div class="book-item finance" style="display:none;">
            <img src="images/book28.jpg" alt="Book 28">
            <h3>The Millionaire Next Door</h3>
            <p>Author: Thomas Stanley</p>
            <p>ISBN: 7070707071</p>
            <a href="pay2.html?book_name=The%20Millionaire%20Next%20Door&book_price=25" class="buy-btn">Buy</a>
        </div>
        <div class="book-item finance" style="display:none;">
            <img src="images/book29.png" alt="Book 29">
            <h3>Principles: Life and Work</h3>
            <p>Author: Ray Dalio</p>
            <p>ISBN: 8080808081</p>
            <a href="pay2.html?book_name=Principles:%20Life%20and%20Work&book_price=30" class="buy-btn">Buy</a>
        </div>
        <div class="book-item finance" style="display:none;">
            <img src="images/book30.jpg" alt="Book 30">
            <h3>Financial Freedom</h3>
            <p>Author: Grant Sabatier</p>
            <p>ISBN: 9090909091</p>
            <a href="pay2.html?book_name=Financial%20Freedom&book_price=35" class="buy-btn">Buy</a>
        </div>
    </div>

    <script>
        function filterBooks() {
            const categorySelect = document.getElementById('categorySelect');
            const selectedCategory = categorySelect.value;
            const bookLists = document.querySelectorAll('.book-item');
            let count = 0;

            bookLists.forEach(book => {
                if (book.classList.contains(selectedCategory) && count < 6) {
                    book.style.display = 'block';
                    count++;
                } else {
                    book.style.display = 'none';
                }
            });
        }
    </script>

</body>
</html>