<?php
session_start();

// Assuming a connection to your database
require 'database.php';

// Redirect to login if user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Fetch the logged-in user's data from the database
$userEmail = $_SESSION['user'];  // Assuming 'user' session stores the email

// Fetch the user data from the database based on the email
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->execute(['email' => $userEmail]);
$user = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to update user details
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update the user data in the database
    if ($password != "") {
        // Hash the new password if it was provided
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE email = :userEmail";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password, 'userEmail' => $userEmail]);
    } else {
        // If no password change, update name and email only
        $sql = "UPDATE users SET name = :name, email = :email WHERE email = :userEmail";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'userEmail' => $userEmail]);
    }

    // After update, reload page to show updated info
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        /* Styling for the profile page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        nav {
           
            padding: 30px;
            display: flex;
            justify-content: end;
            color: #00994d;

        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            color: #00994d;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 22px;
            padding: 10px 15px;
            border-radius: 5px;
            color: #00994d;
          
        }

        nav ul li a:hover {
            background-color: #00994d;
            color: white;
        }

        .content {
            padding: 20px;
            margin: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .profile-form button {
            background-color: #00994d;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .profile-form button:hover {
            background-color: dark#00994d;
        }

        .logout {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
        }
        .banner {
    width: 100%;
    height: 220px;
    background: linear-gradient(to right, #00994d,#00994d); /* A blue gradient */
    color: white;
    text-align: center;
    padding: 30px 50px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.banner h1 {
    margin: 0;
    font-size: 80px;
    font-weight: bold;
}

.banner h4 {
    margin-top: 10px;
    font-size: 28px;
    
}
.sub-banner {
    width: 100%;
    height: 20px;
    background: linear-gradient(to right, #00994d,#00994d); /* A blue gradient */
    color: white;
    text-align: center;
    padding: 30px 50px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.sub-banner h4 {
    margin: 0;
    font-size: 30px;
    font-weight: bold;
   
    text-shadow: 0 0 10px rgba(36, 245, 78, 0.89);
}
.two-column {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    padding: 40px 20px;
    
   
    margin: 0 auto;
    gap: 20px;
}

.text-column {
    flex: 1;
    min-width: 300px;
    margin: 0 auto;
}



.text-column p {
    font-size: 25px;
    line-height: 1.6;
}

.video-column {
    flex: 1;
    min-width: 300px;
}

.video-column video {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
.text p{
width: 100%;
font-size: 25px;
line-height: 1.6;
}
.image-column {
    display: flex;
    justify-content: center; /* Centers the images horizontally */
    align-items: center; /* Centers the images vertically */
    gap: 20px; /* Adds spacing between the images */
    margin: 20px 0; /* Adds some margin above and below the image column */
}

.image-column img {
    max-width: 100%; /* Ensures the images are responsive */
    height: auto; /* Maintains the aspect ratio of the images */
    border-radius: 10px; /* Adds rounded corners to the images */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); /* Adds a subtle shadow for better aesthetics */
}

    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="moneytimeline.php">MoneyTimeline</a></li>
            <li><a href="opportunities.php">Opportunities</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="planner.php">Planner</a></li>
            <li><a href="tracker.php">Tracker</a></li>
            <li><a href="profile.php">Profile</a></li>
        </ul>
    </nav>

   <main>
    <!-- Banner Section -->
<div class="banner">
    <h1>The History and Evolution of Money</h1>
    <h4>From Barter to Blockchain: Tracing the Milestones that Shaped Our Financial World</h4>
</div>
<br>
<div class="sub-banner">
    <h4>Understanding the evolution of money at it's core</h4>
   
</div>
<div class="two-column">
    <div class="text-column">
        <p>
        Understanding how money has evolved is key to making smart financial decisions today. From the early days of trading goods to the digital currencies of today, the way we use money has shaped economies, societies, and personal wealth. By learning how money has transformed over time, you’ll gain a better understanding of why we trust certain systems, how new financial tools like cryptocurrencies emerged, and how to adapt to the changes happening in the financial world today. Whether you're managing personal savings or running a business, knowing the history of money gives you the power to make informed choices and stay ahead in a fast-changing economy.
        </p>
    </div>
    <div class="video-column">
        <video controls width="100%">
            <source src="assets/videos/video1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
</div>
<div class="text">
    <h1>Why Money Matters -The Foundation of Civilization</h1>
    <p>Money has been one of the most powerful tools shaping the rise of human civilization. Long before coins or paper bills, ancient <br> communities relied on trade to meet their needs, exchanging goods and services to survive and prosper. As societies grew and became <br>more complex, the need for a common medium of exchange became crucial. Trade networks connected distant regions, spreading <br> culture, knowledge, and technology. Money, in its earliest and later forms, fueled exploration, built empires, and laid the groundwork for <br> modern economies. By enabling people to assign value to goods and services, money allowed for organized commerce, wealth creation,<br> and the birth of financial institutions that still influence our lives today.</h4>
</div>
<div class="image-column">
    <div class="">
        <img src="assets/history/image1.png" alt="image1">
    </div>
    <div class="">
    <img src="assets/history/image2.png" alt="image2">
    </div>
</div>

<div class="text">
<h1>The Barter System -  The Oldest Form of Trade</h1>
<p>
Long before the invention of money, early human societies relied on a simple but essential practice to survive: bartering. Bartering is the direct exchange of goods and services between individuals or groups without using a medium of exchange like coins or paper money. This system dates back thousands of years and is believed to be one of the earliest forms of economic interaction among humans.
<br>
<br>
In early communities, survival depended on cooperation and mutual benefit. A farmer who grew crops might exchange a portion of his harvest with a herder for livestock. A craftsman could trade handmade tools or pottery for food, clothing, or other necessities. This give-and-take system worked well within small, close-knit groups where trust and social bonds were strong.
<br>
<br>
Bartering wasn't just limited to basic survival. As humans began to settle in villages and towns, local trade became more organized. People specialized in specific trades — some focused on agriculture, others on fishing, hunting, tool-making, or cloth weaving. This specialization made bartering a practical solution to meet varied needs. Villages would often have marketplaces where individuals gathered to trade surplus goods and services in person.
<br>
<br>
As trade networks expanded beyond local regions, bartering also helped establish relationships between distant communities. Early civilizations, such as the Mesopotamians, Egyptians, and Indus Valley traders, bartered grain, spices, textiles, metals, and other valuable commodities across vast distances. Rivers, oceans, and early trade routes like the Silk Road allowed these exchanges to shape early commerce and cultural exchange between civilizations.
<br>
<br>
Despite its benefits in primitive economies, the barter system relied heavily on personal negotiation and agreement. There was no formal price structure or universal value, so each trade depended on perceived worth and immediate needs. In many ways, this early system laid the groundwork for the creation of standardized currency systems that would later emerge to simplify transactions.
<br>
<br>
Bartering also played a significant cultural role. In many societies, it wasn't just an economic transaction but a social event. People built trust, established long-term trading partnerships, and reinforced community bonds through these exchanges. Festivals and fairs were often held to bring traders together in larger gatherings, facilitating bartering on a much broader scale.

</p>
</div>
   </main> 

       
   <?php include 'include/footer.php'; ?>
</body>
</html>


