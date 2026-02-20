<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/user/login.php");
    exit;
}
?>
