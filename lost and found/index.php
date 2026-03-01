<?php
session_start();
include 'config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Lost & Found</title>

<style>
body{
    margin:0;
    font-family:"Segoe UI",sans-serif;
    background:#fdf2f8;
}

/* ===== TOP NAVBAR ===== */
.topbar{
    background:white;
    padding:16px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid #f3f4f6;

    position:fixed;
    top:0;
    left:0;
    width:96%;
    z-index:1000;
}


.topbar h2{
    margin:0;
    color:#be185d;
}

.topbar a{
    margin-left:20px;
    text-decoration:none;
    color:#6b7280;
    font-weight:500;
}

.topbar a:hover{color:#be185d}

/* ===== LAYOUT ===== */
.layout{
    display:flex;
}

/* ===== SIDEBAR ===== */
.sidebar{
    width:220px;
    background:white;
    height:110vh;
    position:fixed;
    top:72px; /* same height as topbar */
    left:0;
    border-right:1px solid #f3f4f6;
    padding:30px 20px;
    overflow-y:auto;
}

.sidebar h3{
    color:#9d174d;
    margin-bottom:20px;
}

.sidebar a{
    display:block;
    padding:12px 14px;
    border-radius:12px;
    text-decoration:none;
    color:#374151;
    margin-bottom:10px;
    background:#fdf2f8;
    font-weight:500;
}

.sidebar a:hover{
    background:#f9a8d4;
    color:#1f2937;
}

/* ===== CONTENT ===== */
.content{
    flex:1;
    margin-left:220px;
    margin-top:72px;
}


/* ===== HERO ===== */
.hero{
    text-align:center;
    padding:70px 20px;
    background:linear-gradient(135deg,#fce7f3,#eff6ff);
}

.hero h1{
    color:#9d174d;
    font-size:36px;
}

.hero p{
    color:#4b5563;
    max-width:520px;
    margin:15px auto;
}

/* ===== ITEMS ===== */
.section-title{
    text-align:center;
    margin:40px 0 20px;
    color:#374151;
}

.items{
    max-width:1100px;
    margin:auto;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
    padding:20px;
}

.card{
    background:white;
    padding:18px;
    border-radius:18px;
    box-shadow:0 10px 22px rgba(0,0,0,0.08);
}

.card img{
    width:100%;
    height:180px;
    object-fit:cover;
    border-radius:14px;
}

.card h3{
    margin:12px 0 6px;
    color:#be185d;
}

.card p{
    font-size:14px;
    color:#4b5563;
}

.badge{
    display:inline-block;
    padding:4px 10px;
    font-size:12px;
    border-radius:999px;
    background:#fce7f3;
    color:#9d174d;
    margin-top:6px;
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

/* ===== FOOTER ===== */
footer{
    background:white;
    padding:30px;
    margin-top:60px;
    text-align:center;
    color:#9ca3af;
    font-size:14px;
}
</style>
</head>
<body>

<!-- ===== TOP NAVBAR ===== -->
<div class="topbar">
    <h2>Lost & Found 💗</h2>

    <div>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="user/profile.php">Profile</a>
            <a href="auth/user/logout.php">Logout</a>
        <?php else: ?>
            <a href="auth/user/login.php">Login</a>
            <a href="auth/user/register.php">Register</a>
        <?php endif; ?>
    </div>
</div>

<div class="layout">

<!-- ===== SIDEBAR ===== -->
<?php if(isset($_SESSION['user_id'])): ?>
<div class="sidebar">
    <h3>My Dashboard</h3>
    <a href="user/add-item.php?type=Lost">Report Lost Item</a>
    <a href="user/add-item.php?type=Found">Report Found Item</a>
    <a href="user/my-items.php">My Items</a>
    <a href="user/all-items.php">All Items</a>

</div>
<?php endif; ?>

<!-- ===== MAIN CONTENT ===== -->
<div class="content">

    <div class="hero">
        <h1>Lost something? Found something?</h1>
        <p>Browse reported items and help reconnect people with what matters.</p>
    </div>

    <h2 class="section-title">Recently Reported Items</h2>

    <div class="items">
    <?php
    $res = mysqli_query($conn, "SELECT * FROM items ORDER BY id DESC LIMIT 6");
    while($row = mysqli_fetch_assoc($res)):
    ?>
        <div class="card">
            <img src="assets/uploads/<?php echo htmlspecialchars($row['image']); ?>">
            <h3><?php echo htmlspecialchars($row['item_name']); ?></h3>
            <p><?php echo htmlspecialchars(substr($row['description'],0,80)); ?>...</p>
            <span class="badge"><?php echo ucfirst($row['type']); ?></span>

            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="user/item-details.php?id=<?php echo $row['id']; ?>" class="btn">
                    View Details
                </a>
            <?php else: ?>
                <a href="auth/user/login.php" class="btn">
                    Login to Respond
                </a>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
    </div>

</div>
</div>

<footer>
    <?php echo date("Y"); ?> Lost & Found System • Built with care 💗
</footer>

</body>
</html>
