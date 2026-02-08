<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
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

<?php
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    $role = $_POST['role'];

    if (empty($username) || empty($password) || empty($birthdate) || empty($role)) {
        echo "<p class='error'>All fields are required!</p>";
    } else {
        $check = $conn->query("SELECT * FROM users WHERE username='$username'");
        if ($check->num_rows > 0) {
            echo "<p class='error'>Username already exists!</p>";
        } else {
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
