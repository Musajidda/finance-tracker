<?php
session_start();
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $category = $_POST['category'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $cost = $_POST['cost'];
    $date = $_POST['date'];
    $note = $_POST['note'] ?? '';  // Default empty if no note is provided
    $userId = $_SESSION['user_id'];

    // Insert the expense into the database
    $sql = "INSERT INTO expenses (user_id, category, item_name, quantity, cost, date, note) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId, $category, $item_name, $quantity, $cost, $date, $note]);

    // Redirect to the tracker page after adding the expense
    header('Location: tracker.php');
    exit();
}
?>
