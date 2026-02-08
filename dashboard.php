<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>
        <?php
        if ($_SESSION['role'] === "admin") {
            echo "Welcome Admin";
        } else {
            echo "Welcome Encoder";
        }
        ?>
    </h2>
    <nav>
        <button onclick="location.href='/AMA/dashboard.php'">Dashboard</button>
        <button onclick="location.href='#'">Categories</button>
        <button onclick="location.href='#'">Products</button>
        <button onclick="location.href='logout.php'">Logout</button>
    </nav>
</div>
</body>
</html>