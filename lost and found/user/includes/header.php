<!DOCTYPE html>
<html>
<head>
<style>
header {
    background: #fff;
    padding: 16px 30px;
    border-bottom: 1px solid #f3f4f6;
    font-family: "Segoe UI", sans-serif;
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-weight: 600;
    color: #be185d;
    font-size: 18px;
}

.nav a {
    margin-left: 20px;
    text-decoration: none;
    color: #6b7280;
    font-weight: 500;
}

.nav a:hover {
    color: #be185d;
}
</style>
</head>

<body>
<header>
    <div class="nav">
        <div class="logo">Lost & Found 💗</div>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="add-item.php">Add Item</a>
            <a href="my-items.php">My Items</a>
            <a href="../auth/user/logout.php">Logout</a>
        </div>
    </div>
</header>
