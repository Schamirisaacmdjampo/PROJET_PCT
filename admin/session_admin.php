<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: /PROJET PCT/admin/login_admin.php");
    exit();
}
