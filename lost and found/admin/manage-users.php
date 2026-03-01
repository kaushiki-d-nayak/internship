<?php
include "includes/auth-check.php";
include "includes/navbar.php";
include "../config/db.php";

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>

<style>
body{
    font-family:"Segoe UI",sans-serif;
    background:#fff1f2;
}

.container{
    max-width:800px;
    margin:60px auto;
}

h2{
    text-align:center;
    color:#9d174d;
    margin-bottom:30px;
}

.user{
    background:white;
    padding:20px;
    border-radius:18px;
    margin-bottom:18px;
    box-shadow:0 10px 22px rgba(0,0,0,0.08);
}

.user b{
    color:#9d174d;
}

.user p{
    margin:4px 0;
    color:#4b5563;
}
</style>
</head>

<body>

<div class="container">
    <h2>Registered Users</h2>

    <?php while($row=mysqli_fetch_assoc($result)): ?>
        <div class="user">
            <p><b><?php echo htmlspecialchars($row['name']); ?></b></p>
            <p><?php echo htmlspecialchars($row['email']); ?></p>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
