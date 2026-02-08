<?php
$host = "localhost";
$user = "root";   // adjust if needed
$pass = "";
$dbname = "user_auth";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
