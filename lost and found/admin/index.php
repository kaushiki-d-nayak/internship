<?php
include "includes/auth-check.php";
include "includes/navbar.php";
include "../config/db.php";

$userCount  = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM users"))[0];
$itemCount  = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM items"))[0];
$lostCount  = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM items WHERE type='Lost'"))[0];
$foundCount = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM items WHERE type='Found'"))[0];
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>
body{
    font-family:"Segoe UI",sans-serif;
    background:linear-gradient(135deg,#ede9fe,#fdf2f8);
}

.admin-container{
    max-width:1100px;
    margin:60px auto;
    padding:20px;
}

h1{
    color:#4c1d95;
    margin-bottom:6px;
}

.subtitle{
    color:#6b7280;
    margin-bottom:30px;
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
}

.stat-card{
    background:white;
    padding:30px;
    border-radius:22px;
    box-shadow:0 15px 30px rgba(0,0,0,0.08);
    text-align:center;
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-6px);
}

.stat-card span{
    font-size:32px;
}

.stat-card h3{
    font-size:36px;
    margin:12px 0 6px;
    color:#6d28d9;
}

.stat-card p{
    margin:0;
    color:#4b5563;
    font-weight:500;
}
</style>
</head>

<body>

<div class="admin-container">
    <h1>Admin Dashboard </h1>
    <p class="subtitle">System overview at a glance</p>

    <div class="stats-grid">
        <div class="stat-card">
            <span></span>
            <h3><?php echo $userCount; ?></h3>
            <p>Total Users</p>
        </div>

        <div class="stat-card">
            <span></span>
            <h3><?php echo $itemCount; ?></h3>
            <p>Total Items</p>
        </div>

        <div class="stat-card">
            <span></span>
            <h3><?php echo $lostCount; ?></h3>
            <p>Lost Items</p>
        </div>

        <div class="stat-card">
            <span></span>
            <h3><?php echo $foundCount; ?></h3>
            <p>Found Items</p>
        </div>
    </div>
</div>

</body>
</html>