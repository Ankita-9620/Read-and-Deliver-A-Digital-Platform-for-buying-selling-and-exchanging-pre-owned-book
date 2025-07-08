<?php
session_start();
if (!isset($_SESSION['book_details']) || !isset($_SESSION['user_details'])) {
    echo "<script>alert('No data available!'); window.location.href = 'exchange.php';</script>";
    exit();
}

$book = $_SESSION['book_details'];
$user = $_SESSION['user_details'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Book</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .details-container {
            max-width: 500px;
            margin: 20px auto;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
            line-height: 1.4;
        }
        .details-container img {
            width: 120px;
            height: auto;
            display: block;
            margin: 0 auto 10px;
            border-radius: 5px;
        }
        .details-container p {
            font-size: 14px;
            margin: 8px 0;
            color: #333;
        }
        .timeline-container {
            max-width: 600px;
            margin: 40px auto;
            position: relative;
        }
        .timeline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            margin-top: 40px;
        }
        .timeline-step {
            width: 80px;
            height: 80px;
            text-align: center;
            background: #e0e0e0;
            border-radius: 50%;
            color: #555;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            transition: background 2s ease-in-out;
        }
        .timeline-line {
            position: absolute;
            top: 50%;
            left: 10%;
            width: 80%;
            height: 4px;
            background-color: #e0e0e0;
            transform: translateY(-50%);
            z-index: -1;
        }
        .moving-ball {
            width: 20px;
            height: 20px;
            background: #4CAF50;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 10%;
            transform: translateY(-50%);
            animation: moveBall 120s linear forwards; /* 120 seconds = 2 minutes */
        }
        @keyframes moveBall {
            0% { left: 10%; }
            25% { left: 30%; }
            50% { left: 50%; }
            75% { left: 70%; }
            100% { left: 90%; } /* Adjusting the final position */
        }
        .blast {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, red, orange, yellow, white);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: explosion 0.5s forwards;
        }
        @keyframes explosion {
            0% { transform: translate(-50%, -50%) scale(0); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(2); opacity: 0; }
        }
        .congratulations {
            display: none;
            text-align: center;
            font-size: 20px;
            color: #007BFF;
            margin-top: 20px;
            font-weight: bold;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            text-align: center;
        }
        .popup button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .popup button:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const ball = document.querySelector(".moving-ball");
            const blast = document.querySelector(".blast");
            const congratulationsMessage = document.querySelector(".congratulations");
            const popup = document.querySelector(".popup");
            const closeButton = document.querySelector(".popup button");

            ball.addEventListener("animationend", () => {
                // Trigger the blast effect when the ball reaches the end
                blast.style.display = "block";
                setTimeout(() => {
                    blast.style.display = "none"; // Hide blast after animation
                }, 500);

                // Show the congratulatory message when the ball reaches the final step
                setTimeout(() => {
                    congratulationsMessage.style.display = "block";
                    popup.style.display = "block"; // Show the popup
                }, 60); // Display after 120 seconds (2 minutes)
            });

            closeButton.addEventListener("click", () => {
                popup.style.display = "none"; // Hide popup when button clicked
            });
        });
    </script>
</head>
<body>
    <header>
        <h1>Track Your Book</h1>
    </header>

    <div class="details-container">
        <img src="<?php echo $book['book_image']; ?>" alt="Book Image">
        <p><strong>Book Name:</strong> <?php echo htmlspecialchars($book['book_name']); ?></p>
        <p><strong>User Name:</strong> <?php echo htmlspecialchars($user['user_name']); ?></p>
        <p><strong>Village:</strong> <?php echo htmlspecialchars($user['village_name']); ?></p>
        <p><strong>District:</strong> <?php echo htmlspecialchars($user['district_name']); ?></p>
        <p><strong>Taluku:</strong> <?php echo htmlspecialchars($user['taluku_name']); ?></p>
        <p><strong>Pin Code:</strong> <?php echo htmlspecialchars($user['pin_code']); ?></p>
    </div>

    <div class="timeline-container">
        <div class="timeline-line"></div>
        <div class="moving-ball"></div>
        <div class="timeline">
            <div class="timeline-step">Order Confirmed</div>
            <div class="timeline-step">Packed</div>
            <div class="timeline-step">Out for Delivery</div>
            <div class="timeline-step">Delivery Successful</div>
        </div>
    </div>

    <div class="blast"></div>
    <div class="congratulations">Congratulations! Your book is in your hands!</div>

    <!-- Popup -->
    <div class="popup">
        <h2>Congratulations!</h2>
        <p>Your book has been successfully delivered!</p>
        <button>Close</button>
    </div>
</body>
</html>
