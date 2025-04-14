<?php
$host = "localhost";
$user = "root"; // use your DB username
$password = ""; // use your DB password
$database = "budget_app";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


