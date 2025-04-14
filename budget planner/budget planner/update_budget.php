<?php
include 'db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$expense = $_POST['expense'];
$savings = $_POST['savings'];

$sql = "UPDATE budgets SET title=?, description=?, expense=?, savings=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssiii", $title, $description, $expense, $savings, $id);
$stmt->execute();

echo "Updated";
?>

