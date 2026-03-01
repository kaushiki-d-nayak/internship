<?php
session_start();
include "../config/db.php";

/* SEARCH + FILTER */
$item_name = $_GET['item_name'] ?? '';
$category = $_GET['category'] ?? '';
$sort     = $_GET['sort'] ?? 'latest';

$query = "SELECT * FROM items WHERE 1";

if (!empty($item_name)) {
    $query .= " AND item_name LIKE '%$item_name%'";
}

if (!empty($category)) {
    $query .= " AND category LIKE '%$category%'";
}

if ($sort === 'oldest') {
    $query .= " ORDER BY date ASC";
} else {
    $query .= " ORDER BY date DESC";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
<title>All Items • Lost & Found</title>

<style>
body{
    margin:0;
    padding-top:72px;
    font-family:"Segoe UI",sans-serif;
    background:#fdf2f8;
}

/* TOPBAR */
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

/* CONTAINER */
.container{
    max-width:1100px;
    margin:40px auto;
    padding:20px;
}

/* FILTER BAR */
.filter{
    display:flex;
    gap:15px;
    margin-bottom:30px;
}

.filter input,
.filter select{
    padding:10px 14px;
    border-radius:999px;
    border:1px solid #ddd;
    outline:none;
}

/* GRID */
.items{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
}

/* CARD */
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

.card h3{color:#be185d;margin:10px 0 5px}
.card p{font-size:14px;color:#4b5563}

.badge{
    display:inline-block;
    padding:4px 12px;
    font-size:12px;
    border-radius:999px;
    background:#fce7f3;
    color:#9d174d;
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
</style>
</head>

<body>

<div class="topbar">
    <h2>Lost & Found 💗</h2>
    <a href="../index.php">back</a>
</div>

<div class="container">

<h2>All Reported Items</h2>

<!-- FILTER -->
<form class="filter" method="GET">
    <input type="text" name="item_name" placeholder="Search item name..."
           value="<?php echo htmlspecialchars($item_name); ?>">

    <input type="text" name="category" placeholder="Search category..."
           value="<?php echo htmlspecialchars($category); ?>">

    <select name="sort">
        <option value="latest" <?php if($sort=='latest') echo 'selected'; ?>>Latest</option>
        <option value="oldest" <?php if($sort=='oldest') echo 'selected'; ?>>Oldest</option>
    </select>

    <button type="submit">Search</button>
</form>

<!-- ITEMS -->
<div class="items">
<?php while($row = mysqli_fetch_assoc($result)): ?>
    <div class="card">
        <?php if($row['image']): ?>
            <img src="../assets/uploads/<?php echo $row['image']; ?>">
        <?php endif; ?>

        <h3><?php echo htmlspecialchars($row['item_name']); ?></h3>
        <p><?php echo htmlspecialchars(substr($row['description'],0,80)); ?>...</p>

        <span class="badge"><?php echo ucfirst($row['type']); ?></span>
        <span class="badge"><?php echo htmlspecialchars($row['category']); ?></span>

        <a href="item-details.php?id=<?php echo $row['id']; ?>" class="btn">
                    View Details
                </a>
    </div>
<?php endwhile; ?>
</div>

</div>

</body>
</html>
