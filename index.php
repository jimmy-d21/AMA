<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Hide the error message after 3 seconds
            setTimeout(() =>{
                let errorMsg = document.querySelector(".error");
                if (errorMsg) {
                    errorMsg.style.display = "none";
                }
            }, 3000);
    </script>
</head>
<body>
<div class="container">
    <h2>Login</h2>

    <?php
    // Show error messages inside the form
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

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="login">Login</button>
    </form>
    <a href="/AMA/register.php">Don't have an account? Register</a>
</div>
</body>
</html>
