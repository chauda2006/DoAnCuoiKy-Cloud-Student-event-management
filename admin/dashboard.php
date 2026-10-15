<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'check_admin.php';
require_once '../database.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Quản lý Sự kiện Sinh viên</title>
    
    <!-- Liên kết file CSS bên ngoài với tham số thời gian để tránh lưu cache cũ -->
    <link rel="stylesheet" href="../css/dashboard.css?v=<?php echo time(); ?>">
    <!-- Nếu bạn có dùng icon FontAwesome thì giữ lại dòng này -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Thanh Menu trái (Sidebar) -->
    <div class="sidebar">
        <h2>QUẢN LÝ SỰ KIỆN</h2>
        <!-- Nút Trở về trang chủ -->
        <a href="../index.php" class="menu-item home-btn">
            <i class="fas fa-home"></i> Trang chủ
        </a>
        <a href="dashboard.php" class="active">📊 Tổng quan</a>
        <a href="destinations.php">🎉 Quản lý Sự kiện</a>
        <a href="users_list.php">👥 Danh sách Người dùng</a>
        <a href="logout.php" class="logout-btn">LOGOUT</a>
    </div>

    <!-- Nội dung chính bên phải -->
    <div class="main-content">
        <div class="welcome-card">
            <h3>Xin chào, <b><?= htmlspecialchars($_SESSION['admin_user'] ?? 'Admin') ?></b>!</h3>
            <p>Hệ thống Quản lý Sự kiện Sinh viên BDU</p>
        </div>

        <div class="welcome-card" style="margin-top: 20px;">
            <p>Chào mừng bạn đến với trang quản trị hệ thống. Hãy chọn các danh mục bên trái để thực hiện Thêm, Sửa, Xóa dữ liệu sự kiện hoặc kiểm tra tài khoản người dùng.</p>
        </div>
    </div>

</body>
</html>