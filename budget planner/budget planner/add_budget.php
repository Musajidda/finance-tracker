<?php
include 'db.php';

$title = $_POST['title'];
$description = $_POST['description'];
$expense = $_POST['expense'];
$savings = $_POST['savings'];

$sql = "INSERT INTO budgets (title, description, expense, savings) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $title, $description, $expense, $savings);
$stmt->execute();

echo "Success";
?>


