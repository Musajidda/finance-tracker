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
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Styling for the profile page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
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
           
        </ul>
    </nav>

    

       
    </div>
    <!-- Profile Page Content -->
    <div class="content">
        <h1>Profile: <?php echo $_SESSION['user']; ?></h1>

        <!-- Profile Form -->
        <form action="profile.php" method="POST" class="profile-form">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="password">Password (Leave blank to keep current password)</label>
            <input type="password" id="password" name="password" placeholder="New password">

            <button type="submit">Update Profile</button>
        </form>
        <a href="logout.php" class="logout">Logout</a>

        <?php include 'include/footer.php'; ?>
</body>
</html>