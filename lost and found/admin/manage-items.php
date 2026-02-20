<?php
include "includes/auth-check.php";
include "includes/navbar.php";
include "../config/db.php";

$result = mysqli_query($conn, "SELECT * FROM items ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Items</title>

<style>
body{
    font-family:"Segoe UI",sans-serif;
    background:#f5f3ff;
}

.container{
    max-width:1100px;
    margin:60px auto;
}

h2{
    text-align:center;
    color:#4c1d95;
    margin-bottom:30px;
}

.card{
    background:white;
    padding:20px;
    margin-bottom:20px;
    border-radius:20px;
    display:flex;
    gap:22px;
    align-items:flex-start;
    box-shadow:0 12px 28px rgba(0,0,0,0.08);
}

.card img{
    width:130px;
    height:130px;
    object-fit:cover;
    border-radius:16px;
}

.details h3{
    margin:0;
    color:#6d28d9;
}

.details p{
    font-size:14px;
    color:#4b5563;
    margin:8px 0;
}

.badges span{
    display:inline-block;
    padding:4px 12px;
    margin-right:8px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.type{
    background:#ede9fe;
    color:#6d28d9;
}

.category{
    background:#fce7f3;
    color:#9d174d;
}
</style>
</head>

<body>

<div class="container">
    <h2>Manage Items</h2>

    <?php while($row=mysqli_fetch_assoc($result)): ?>
    <div class="card">
        <img src="../assets/uploads/<?php echo htmlspecialchars($row['image']); ?>">

        <div class="details">
            <h3><?php echo htmlspecialchars($row['item_name']); ?></h3>
            <p><?php echo htmlspecialchars($row['description']); ?></p>

            <div class="badges">
                <span class="type"><?php echo ucfirst($row['type']); ?></span>
                <span class="category"><?php echo htmlspecialchars($row['category']); ?></span>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

</body>
</html>
