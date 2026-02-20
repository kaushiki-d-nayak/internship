<?php
include "includes/auth-check.php";
include "../config/db.php";

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM items WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Items</title>

<style>
body {
    font-family: "Segoe UI", sans-serif;
    background: #fdf2f8;
    padding-top:72px;
}

.container {
    max-width: 900px;
    margin: 50px auto;
}

.card {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.card img {
    width: 120px;
    border-radius: 12px;
}

h3 {
    color: #be185d;
}

.btn{
    display:block;
    text-align:center;
    margin-top:14px;
    padding:10px;
    border-radius:999px;
    text-decoration:none;
    font-weight:600;
    background:#f9a8d4;
    color:#1f2937;
}

.btn:hover{
    background:#f472b6;
    color:white;
}

.topbar{
    position:fixed;
    top:0;
    left:0;
    width:96%;
    height:72px;
    background:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 30px;
    border-bottom:1px solid #f3f4f6;
}

.topbar h2{color:#be185d;margin:0}
</style>
</head>

<body>

<div class="topbar">
    <h2>Lost & Found 💗</h2>
    <a href="../index.php">back</a>
</div>

<div class="container">
    <h2>My Items</h2>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="card">
            <h3><?php echo $row['item_name']; ?> (<?php echo $row['type']; ?>)</h3>
            <p><?php echo $row['description']; ?></p>
            <img src="../assets/uploads/<?php echo $row['image']; ?>">
            <a href="item-details.php?id=<?php echo $row['id']; ?>" class="btn">
                    View Details
                </a>
        </div>
    <?php } ?>
</div>

</body>
</html>
