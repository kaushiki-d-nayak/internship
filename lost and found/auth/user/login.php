<?php
session_start();
include "../../config/db.php";

$msg = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $row = mysqli_fetch_assoc($res);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        header("Location: ../../index.php");
    } else {
        $msg = "Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Login</title>
<style>
body {
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #fdf2f8, #eff6ff);
}

.login-box {
    width: 340px;
    margin: 110px auto;
    padding: 26px;
    background: white;
    border-radius: 14px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.08);
}

h2 {
    text-align: center;
    color: #374151;
}

input {
    width: 100%;
    padding: 12px;
    margin-top: 12px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
}

button {
    width: 100%;
    padding: 12px;
    margin-top: 18px;
    border-radius: 10px;
    background: #93c5fd;
    border: none;
    font-weight: 600;
    color: #1f2937;
}

button:hover {
    background: #60a5fa;
    color: white;
}

.error {
    text-align: center;
    color: #ef4444;
    font-size: 14px;
}
</style>

</head>

<body>
<div class="login-box">
    <h2>User Login</h2>
    <p class="error"><?php echo $msg; ?></p>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button><br><br>
        Don't have an account?   <a href="register.php">Register here</a>
    </form>
</div>
</body>
</html>
