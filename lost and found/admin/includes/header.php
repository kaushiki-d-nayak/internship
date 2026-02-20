<!DOCTYPE html>
<html>
<head>
<style>
header {
    background: #ffffff;
    padding: 18px 30px;
    border-bottom: 1px solid #e5e7eb;
    font-family: "Segoe UI", sans-serif;
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-weight: 700;
    color: #6d28d9;
    font-size: 18px;
}

.nav a {
    margin-left: 22px;
    text-decoration: none;
    color: #4b5563;
    font-weight: 500;
}

.nav a:hover {
    color: #6d28d9;
}
</style>
</head>

<body>
<header>
    <div class="nav">
        <div class="logo">Admin Panel 💼</div>
        <div>
            <a href="index.php">Dashboard</a>
            <a href="manage-items.php">Items</a>
            <a href="manage-users.php">Users</a>
            <a href="../auth/admin/logout.php">Logout</a>
        </div>
    </div>
</header>
