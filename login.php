<?php
require 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Store both email AND user ID in session
        $_SESSION['user'] = $user['email'];
        $_SESSION['user_id'] = $user['id'];  // Add this line
        
        header("Location: moneytimeline.php"); // Redirect to index
        exit();
    } else {
        $_SESSION['error'] = "Invalid credentials!";
        header("Location: login.php"); // Redirect back to login page
        exit();
    }
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: url('assets/signup/background.jpg') no-repeat center center/cover  ;
            background-size: 75% 70% 70%; /* Adjust the percentage as needed */
            
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 230vh;
            
            font-family: Arial, sans-serif;
            position: unset;
        }
        .main-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 800px;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 30px 2px;
            box-shadow: 0px 0px 10px rgba(0, 128, 0, 0.5);
            text-align: center;
            width: 350px;
            position: relative;
            margin: 20px;
            border: 5px solid #00994d;
        }
        .logo {
            position: absolute;
            top: -80px;
            left: -40%;
            transform: translateX(-50%);
            width: 100px;
        }
        .profile-icon {
            width: 50px;
            height: 50px;
            border: 4px solid #00994d;
            
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px auto;
            color: #00994d;
        }
        .profile-icon i {
            font-size: 24px;
            color: #00994d;
        }
        .container h2 {
            color: #00994d;
        }
        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            background: #00994d;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
            background: dark#00994d;
        }
        .signup-section {
           
            text-align: center;
            padding: 20px;
           margin-top: 20px;
            width: 300px;
        }
        .signup-section h2 p {
            color: black;
            text-align: center;
        }
        .signup-btn {
            background: #00994d;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 150px;
        }
        .signup-btn:hover {
            background: dark#00994d;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .input-group {
            position: relative;
            margin-bottom: 15px;
            justify-content: center;
            display: flex;
        }

        .input-group input {
            width: 100%;
            padding: 15px 40px 10px 30px; /* Add space for the icon */
            border: 3px solid #00994d;
            border-radius: 5px;

        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: black;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="wrapper">
            <img src="assets/signup/logo.png" alt="Logo" class="logo">
            <div class="container">
                <div class="profile-icon">
                    <i class="fa fa-user"></i>
                </div>
                <h2>WELCOME</h2>
              
                <form action="login.php" method="POST">
                <div class="input-group">
                <i class="fa fa-envelope"></i> <!-- Email Icon -->
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="fa fa-lock"></i> <!-- Password Icon -->
                <input type="password" name="password" placeholder="Password" required>
            </div>

                    <button type="submit" class="btn">Login</button>
                </form>
            </div>
        </div>
        <div class="signup-section">
            <h2>New here?</h2>
            <p>Create an account to get started</p>
            <a href="signup.php"> <button type="submit" class="signup-btn">Sign Up</button></a>
               
            
        </div>
    </div>
</body>
</html>
