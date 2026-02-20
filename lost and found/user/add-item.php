<?php
include "includes/auth-check.php";
include "../config/db.php";

if (isset($_POST['submit'])) {

    $item_name   = mysqli_real_escape_string($conn, $_POST['item_name']);
    $category    = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location    = mysqli_real_escape_string($conn, $_POST['location']);
    $lost_date   = $_POST['lost_date'];
    $type        = $_POST['type'];
    $status      = ($type == "Found") ? "Found" : "Lost";
    $user_id     = $_SESSION['user_id'];

    // Image upload
    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "../assets/uploads/".$image);

    mysqli_query($conn, "
        INSERT INTO items
        (item_name, category, description, image, location, date, type, status, user_id)
        VALUES
        ('$item_name', '$category', '$description', '$image', '$location', '$lost_date', '$type', '$status', '$user_id')
    ");

    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Lost / Found Item</title>

<style>
body{
    font-family:'Poppins',sans-serif;
    background:#fff5fb;
}

.form-box{
    width:380px;
    margin:60px auto;
    background:white;
    padding:28px;
    border-radius:18px;
    box-shadow:0 12px 28px rgba(255,150,200,.25);
}

h3{
    text-align:center;
    color:#9d174d;
    margin-bottom:15px;
}

input, textarea, select{
    width:100%;
    padding:11px;
    margin:9px 0;
    border-radius:12px;
    border:1px solid #e5e7eb;
    outline:none;
    font-size:14px;
}

textarea{
    resize:none;
    height:90px;
}

select{
    background:white;
}

button{
    width:100%;
    background:#ff8dc7;
    border:none;
    padding:13px;
    color:white;
    border-radius:999px;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    margin-top:10px;
}

button:hover{
    background:#f472b6;
}
</style>
</head>

<body>

<div class="form-box">
<form method="post" enctype="multipart/form-data">

    <h3>Add Lost / Found Item</h3>

    <input type="text" name="item_name" placeholder="Item name" required>

    <select name="category" required>
        <option value="">Select category</option>
        <option>Electronics</option>
        <option>Wallet / Purse </option>
        <option>ID Card / Documents</option>
        <option>Keys</option>
        <option>Bag </option>
        <option>Jewellery</option>
        <option>Clothes</option>
        <option>Cosmetics</option>
        <option>Books</option>
        <option>Others</option>
    </select>

    <textarea name="description" placeholder="Describe the item" required></textarea>

    <input type="text" name="location" placeholder="Location where lost/found" required>

    <input type="date" name="lost_date" required>

    <select name="type" required>
        <option value="">Select type</option>
        <option value="Lost">Lost Item</option>
        <option value="Found">Found Item</option>
    </select>

    <input type="file" name="image" required>

    <button name="submit">Submit Item</button>

</form>
</div>

</body>
</html>
