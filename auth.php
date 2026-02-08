<?php
session_start();
include("db.php");

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "<p class='error'>All fields are required!</p>";
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            echo "<p class='error'>Invalid Credentials</p>";
        } else {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                header("Location: /AMA/dashboard.php");
                exit();
            } else {
                echo "<p class='error'>Invalid Credentials</p>";
            }
        }
    }
}
?>