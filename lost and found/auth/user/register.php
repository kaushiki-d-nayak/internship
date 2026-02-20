<?php
session_start();
include "../../config/db.php";

$msg = "";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if (mysqli_query($conn, $sql)) {
        $msg = "Registration successful. Please login.";
    } else {
        $msg = "Error: Email may already exist.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Register</title>
<style>
body {
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #fce7f3, #e0f2fe);
}

.form-box {
    width: 360px;
    margin: 90px auto;
    padding: 28px;
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

h2 {
    text-align: center;
    color: #374151;
}

input {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
}

input:focus {
    outline: none;
    border-color: #f9a8d4;
}

button {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    background: #f9a8d4;
    color: #4b5563;
    font-weight: 600;
    cursor: pointer;
}

button:hover {
    background: #f472b6;
    color: white;
}

.msg {
    text-align: center;
    color: #10b981;
    font-size: 14px;
}
</style>

</head>

<body>
<div class="form-box">
    <h2>User Register</h2>
    <p class="msg"><?php echo $msg; ?></p>

    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="register">Register</button><br><br>
        Already have an account?   <a href="login.php">login here</a>
    </form>
</div>
</body>
</html>
