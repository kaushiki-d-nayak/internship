<?php
include "includes/auth-check.php";
include "../config/db.php";

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

// Fetch item
$itemQuery = mysqli_query($conn, "SELECT * FROM items WHERE id='$id'");
$item = mysqli_fetch_assoc($itemQuery);

if (!$item) {
    echo "Item not found.";
    exit;
}

// Check if item already claimed
$claimQuery = mysqli_query($conn, "SELECT * FROM claims WHERE item_id='$id'");
$claim = mysqli_fetch_assoc($claimQuery);

// Handle claim button
if (isset($_POST['claim'])) {

    // Cannot claim own item
    if ($item['user_id'] == $user_id) {
        $error = "You cannot claim your own item.";
    }
    // Already claimed
    elseif ($claim) {
        $error = "This item has already been claimed.";
    }
    else {
        mysqli_query($conn, "
            INSERT INTO claims (item_id, user_id, claimed_at)
            VALUES ('$id', '$user_id', NOW())
        ");

        header("Location: item-details.php?id=$id");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Item Details</title>

<style>
body{
    margin:0;
    font-family:"Segoe UI",sans-serif;
    padding-top:72px;
    background:linear-gradient(135deg,#fce7f3,#eff6ff);
}

.box{
    max-width:620px;
    margin:60px auto;
    background:white;
    padding:30px;
    border-radius:22px;
    box-shadow:0 20px 40px rgba(0,0,0,0.08);
}

img{
    width:100%;
    height:280px;
    object-fit:cover;
    border-radius:18px;
    margin-bottom:18px;
}

h2{
    margin:0;
    color:#9d174d;
}

.info{
    margin:10px 0;
    color:#4b5563;
    font-size:14px;
}

.badge{
    display:inline-block;
    padding:6px 14px;
    background:#fce7f3;
    color:#9d174d;
    border-radius:999px;
    font-size:13px;
    margin-top:10px;
}

.desc{
    margin-top:16px;
    color:#374151;
    line-height:1.6;
}

.claim-btn{
    width:100%;
    margin-top:25px;
    padding:14px;
    border:none;
    border-radius:999px;
    background:#f472b6;
    color:white;
    font-weight:600;
    font-size:15px;
    cursor:pointer;
}

.claim-btn:hover{
    background:#ec4899;
}

.claimed-msg{
    margin-top:25px;
    text-align:center;
    font-weight:600;
    color:#9d174d;
}

.error{
    margin-top:20px;
    background:#fee2e2;
    color:#991b1b;
    padding:12px;
    border-radius:12px;
    text-align:center;
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

<div class="box">

    <img src="../assets/uploads/<?php echo htmlspecialchars($item['image']); ?>">

    <h2><?php echo htmlspecialchars($item['item_name']); ?></h2>

    <div class="info">
        <b>Category:</b> <?php echo htmlspecialchars($item['category']); ?><br>
        <b>Type:</b> <?php echo ucfirst($item['type']); ?><br>
        <b>Location:</b> <?php echo htmlspecialchars($item['location']); ?><br>
        <b>Date:</b> <?php echo htmlspecialchars($item['date']); ?>
    </div>

    <span class="badge"><?php echo ucfirst($item['type']); ?> Item</span>

    <div class="desc">
        <?php echo nl2br(htmlspecialchars($item['description'])); ?>
    </div>

    <!-- ERROR -->
    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <!-- BUTTON LOGIC -->
    <?php if ($item['user_id'] != $user_id && !$claim): ?>

        <form method="post">
            <button class="claim-btn" name="claim">
                <?php
                    echo ($item['type'] == "Found")
                        ? "I found this item 💗"
                        : "This is my item 💗";
                ?>
            </button>
        </form>

    <?php elseif ($claim && $claim['user_id'] == $user_id): ?>

        <div class="claimed-msg">
            ✨ You have claimed this item
        </div>

    <?php elseif ($claim): ?>

        <div class="claimed-msg">
            ⚠️ This item has already been claimed
        </div>

    <?php endif; ?>

</div>

</body>
</html>
