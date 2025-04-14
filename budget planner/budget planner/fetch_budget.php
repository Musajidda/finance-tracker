<?php
include 'db.php';

$result = $conn->query("SELECT * FROM budgets ORDER BY id DESC");

$budgets = array();
while ($row = $result->fetch_assoc()) {
    $budgets[] = $row;
}

echo json_encode($budgets);
?>


