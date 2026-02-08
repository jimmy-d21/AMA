<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script>
        // Hide error or success messages after 3 seconds
            setTimeout(function() {
                let errorMsg = document.querySelector(".error");
                let successMsg = document.querySelector(".message");
                if (errorMsg) {
                    errorMsg.style.display = "none";
                }
                if (successMsg) {
                    successMsg.style.display = "none";
                }
            }, 3000); // 3000 ms = 3 seconds
    </script>
</head>
<body>
<div class="container">
    <h2>Register</h2>

    <?php
    if (isset($_POST['register'])) {
        $username   = trim($_POST['username']);
        $password   = $_POST['password'];
        $confirmPwd = $_POST['confirm_password'];
        $birthdate  = $_POST['birthdate'];
        $role       = $_POST['role'];

        // Check for empty fields
        if (empty($username) || empty($password) || empty($confirmPwd) || empty($birthdate) || empty($role)) {
            echo "<p class='error'>All fields are required!</p>";
        } elseif ($password !== $confirmPwd) {
            // Check if passwords match
            echo "<p class='error'>Passwords do not match!</p>";
        } else {
            // Check if username already exists
            $check = $conn->query("SELECT * FROM users WHERE username='$username'");
            if ($check->num_rows > 0) {
                echo "<p class='error'>Username already exists!</p>";
            } else {
                // Hash password and insert into database
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (username, password, role, date_access) 
                        VALUES ('$username', '$hashed', '$role', '$birthdate')";
                if ($conn->query($sql) === TRUE) {
                    echo "<p class='message'>Registration successful!</p>";
                    header("Location: /AMA/index.php");
                } else {
                    echo "<p class='error'>Error: " . $conn->error . "</p>";
                }
            }
        }
    }
    ?>

    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <input type="date" name="birthdate">
        <select name="role">
            <option value="encoder">Encoder</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" name="register">Register</button>
    </form>
    <a href="/AMA/index.php">Already have an account? Login</a>
</div>
</body>
</html>
