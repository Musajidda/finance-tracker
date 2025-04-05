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
            color: green;

        }

        nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            color: green;
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
            color: green;
          
        }

        nav ul li a:hover {
            background-color: green;
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
            background-color: green;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .profile-form button:hover {
            background-color: darkgreen;
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
    background: linear-gradient(to right, green,green); /* A blue gradient */
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
    background: linear-gradient(to right, green,green); /* A blue gradient */
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


   </main> 

       
  
</body>
</html>
