<?php
session_start();
include "../../config/db.php";

$msg = "";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin (name, email, password) VALUES ('$name','$email','$password')";
    if (mysqli_query($conn, $sql)) {
        $msg = "Admin registered successfully";
    } else {
        $msg = "Error registering admin";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Register</title>
<style>
body {
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #ede9fe, #fce7f3);
}

.form {
    width: 380px;
    margin: 90px auto;
    background: #ffffff;
    padding: 28px;
    border-radius: 16px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.1);
}

h2 {
    text-align: center;
    color: #4c1d95;
}

input {
    width: 100%;
    padding: 12px;
    margin-top: 12px;
    border-radius: 10px;
    border: 1px solid #ddd6fe;
    background: #fafafa;
}

button {
    width: 100%;
    padding: 12px;
    margin-top: 18px;
    border-radius: 10px;
    background: #c4b5fd;
    border: none;
    font-weight: 600;
    color: #312e81;
}

button:hover {
    background: #a78bfa;
    color: white;
}
</style>

</head>

<body>
<div class="form">
    <h2>Admin Register</h2>
    <p><?php echo $msg; ?></p>
    <form method="POST">
        <input type="text" name="name" placeholder="Admin Name" required>
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="register">Register</button><br><br>
        Already have an account?   <a href="login.php">login here</a>
    </form>
</div>
</body>
</html>
