<?php
require 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize email input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    // Sanitize password inputs
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: signup.php");
        exit;
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: signup.php");
        exit;
    }

    // Check password length
    if (strlen($password) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long.";
        header("Location: signup.php");
        exit;
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL statement to insert data into the users table
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $pdo->prepare($sql);

    // Execute the query and check for success
    if ($stmt->execute(['email' => $email, 'password' => $hashedPassword])) {
        $_SESSION['success'] = "Signup successful! You can now login.";
        header("Location: login.php");
        exit;
    } else {
        $_SESSION['error'] = "Signup failed. Please try again.";
        header("Location: signup.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: url('assets/signup/background.jpg') no-repeat center center/cover;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 1000px;
        }
        
        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 30px 2px;
            box-shadow: 0px 0px 10px rgba(0, 128, 0, 0.5);
            text-align: center;
            width: 100%;
            max-width: 350px;
            position: relative;
            margin-bottom: 20px;
            border: 5px solid #00994d;
        }
        
        .logo {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: auto;
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
            margin: 10px 0;
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
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #007a3d;
        }
        
        .login-section {
            background: rgba(255, 255, 255, 0.9);
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0px 0px 10px rgba(0, 128, 0, 0.5);
            border: 5px solid #00994d;
        }
        
        .login-section h2 {
            color: #00994d;
            margin: 0 0 10px 0;
        }
        
        .login-section p {
            color: #333;
            margin-bottom: 15px;
        }
        
        .login-btn {
            background: #00994d;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 150px;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s;
        }
        
        .login-btn:hover {
            background: #007a3d;
        }
        
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }
        
        .input-group input {
            width: 100%;
            padding: 15px 15px 15px 40px;
            border: 3px solid #00994d;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        .input-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #00994d;
            font-size: 18px;
        }
        
        /* Error message styling */
        .error-message {
            color: #ff0000;
            margin: 10px 0;
            font-weight: bold;
        }
        
        /* Success message styling */
        .success-message {
            color: #00994d;
            margin: 10px 0;
            font-weight: bold;
        }
        
        /* Responsive adjustments */
        @media (min-width: 768px) {
            .main-container {
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
            }
            
            .wrapper {
                margin-right: 40px;
                margin-bottom: 0;
            }
            
            .logo {
                top: -80px;
                left: -40px;
                transform: none;
            }
        }
        
        @media (max-width: 480px) {
            .wrapper {
                padding: 20px 15px;
            }
            
            .input-group input {
                padding: 12px 12px 12px 35px;
            }
            
            .input-group i {
                left: 10px;
            }
            
            .btn, .login-btn {
                padding: 10px;
            }
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
                <h2>CREATE ACCOUNT</h2>
                
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
                <?php endif; ?>
                
                <form action="signup.php" method="POST" onsubmit="return validateForm()">
                    <div class="input-group">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="btn">Sign Up</button>
                </form>
            </div>
        </div>
        <div class="login-section">
            <h2>Already a member?</h2>
            <p>Login to your account and continue learning/budgeting</p>
            <a href="login.php"><button type="button" class="login-btn">Login</button></a>
        </div>
    </div>

    <script>
        function validateForm() {
            const password = document.querySelector('[name="password"]').value;
            const confirmPassword = document.querySelector('[name="confirm_password"]').value;
            
            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }
            
            if (password.length < 8) {
                alert("Password must be at least 8 characters long!");
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>
