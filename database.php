<?php
$host = 'localhost';
$dbname = 'do_an_cuoi_ky'; // Tên database chính xác của bạn
$username = 'root';         // Tên đăng nhập XAMPP mặc định
$password = '';             // Mật khẩu XAMPP mặc định (để trống)

try {
    // Khởi tạo biến $pdo kết nối
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}
?>