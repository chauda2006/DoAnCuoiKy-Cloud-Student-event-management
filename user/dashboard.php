<?php
require_once 'check_user.php';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang cá nhân</title>
</head>
<body>
    <h1>Chào mừng, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <p>Đây là trang cá nhân dành cho người dùng.</p>
    <a href="../index.php">Trở về trang chủ</a> | 
    <a href="logout.php">Đăng xuất</a>
</body>
</html>