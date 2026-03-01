<?php
session_start();
include "../../config/db.php";

$msg = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");
    $row = mysqli_fetch_assoc($res);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['admin_id'] = $row['id'];
        header("Location: ../../admin/index.php");
    } else {
        $msg = "Invalid admin login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<style>
body {
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #fdf4ff, #eef2ff);
}

.login {
    width: 340px;
    margin: 120px auto;
    background: #ffffff;
    padding: 26px;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #4338ca;
}

input {
    width: 100%;
    padding: 12px;
    margin-top: 12px;
    border-radius: 10px;
    border: 1px solid #e0e7ff;
}

button {
    width: 100%;
    padding: 12px;
    margin-top: 18px;
    border-radius: 10px;
    background: #a5b4fc;
    border: none;
    font-weight: 600;
}

button:hover {
    background: #818cf8;
    color: white;
}
</style>

</head>

<body>
<div class="login">
    <h2>Admin Login</h2>
    <p><?php echo $msg; ?></p>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button><br><br>
        Don't have an account?   <a href="register.php">Register here</a>
    </form>
</div>
</body>
</html>
