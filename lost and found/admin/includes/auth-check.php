<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../auth/admin/login.php");
    exit;
}
?>
