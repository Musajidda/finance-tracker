<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION['user'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $userEmail]);
$user = $stmt->fetch();

// Update profile (including monthly income)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $income = isset($_POST['monthly_income']) ? floatval($_POST['monthly_income']) : 0;
    $password = $_POST['password'];

    // Validate income
    if ($income < 0) {
        $error = "Monthly income cannot be negative";
    } else {
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE users SET name = :name, email = :email, password = :password, monthly_income = :income WHERE email = :userEmail";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'income' => $income,
                'userEmail' => $userEmail
            ]);
        } else {
            $sql = "UPDATE users SET name = :name, email = :email, monthly_income = :income WHERE email = :userEmail";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'income' => $income,
                'userEmail' => $userEmail
            ]);
        }

        $_SESSION['user'] = $email;
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    }
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
            border-radius: 8px;
        }

        .profile-form input, .profile-form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .profile-form button {
            background-color: #00994d;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }

        .profile-form button:hover {
            background-color: #007a3d;
        }

        .logout {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
            color: #333;
            text-decoration: none;
        }

        .logout:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }

        .alert-error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }

        .financial-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px solid #ddd;
        }

        .financial-info h3 {
            margin-top: 0;
            color: #2c3e50;
        }

        /* Navigation styles */
        nav {
            background-color: #2c3e50;
            padding: 15px 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #34495e;
        }
    </style>
</head>
<body>
<?php include 'include/header.php'; ?>

    <!-- Profile Page Content -->
    <div class="content">
        <h1>Profile: <?php echo htmlspecialchars($user['email']); ?></h1>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- Financial Information Section -->
        <div class="financial-info">
            <h3>Financial Information</h3>
            <p><strong>Current Monthly Income:</strong> ₦<?php echo number_format($user['monthly_income'], 2); ?></p>
            <p>Update your income to ensure accurate budgeting in the Tracker and Planner.</p>
        </div>

        <!-- Profile Form -->
        <form action="profile.php" method="POST" class="profile-form">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="monthly_income">Monthly Income (₦)</label>
            <input type="number" id="monthly_income" name="monthly_income" 
                   min="0" step="100" 
                   value="<?php echo htmlspecialchars($user['monthly_income']); ?>" required>

            <label for="password">Password (Leave blank to keep current password)</label>
            <input type="password" id="password" name="password" placeholder="New password">

            <button type="submit">Update Profile</button>
        </form>

        <a href="logout.php" class="logout">Logout</a>
    </div>

    <?php include 'include/footer.php'; ?>
</body>
</html>