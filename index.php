<?php
// BẮT BUỘC: Luôn đặt session_start() ở dòng đầu tiên của file index trước mọi mã HTML
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// (Tùy chọn) Nhúng file kết nối cơ sở dữ liệu của bạn nếu cần dùng ở dưới
// include 'database.php'; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Sự Kiện Sinh Viên</title>
    
    <!-- Mở file index.php và thay thế phần nhúng CSS cũ bằng 2 dòng này -->
<link rel="stylesheet" type="text/css" href="./css/header.css?v=<?php echo time(); ?>">
<link rel="stylesheet" type="text/css" href="./css/index.css?v=<?php echo time(); ?>">

</head>
<body>

    <!-- 1. Nhúng file Header chứa cả Logo, Menu Phân Quyền và Khối Tài Khoản -->
    <?php include 'header.php'; ?>

    <!-- 2. Nội dung chính của trang chủ (Dashboard) -->
    <main class="main-content">
        <div class="container">
            <h1>Hệ Thống Quản Lý Sự Kiện Sinh Viên</h1>
            <p class="welcome-text">Chào mừng bạn đến với trang quản trị dự án Cloud Computing.</p>
            
            <!-- Khu vực nội dung hiển thị động tùy theo quyền của tài khoản -->
            <div class="dashboard-grid">
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <!-- Giao diện tính năng nhanh dành riêng cho ADMIN -->
                    <div class="card card-admin">
                        <h3>Chức năng Admin</h3>
                        <p>Bạn đang đăng nhập với quyền <strong>Quản trị viên</strong>. Bạn có thể thêm sự kiện mới hoặc phê duyệt danh sách sinh viên.</p>
                        <a href="quan-ly-sinh-vien.php" class="card-btn">Đến trang quản lý</a>
                    </div>
                <?php else: ?>
                    <!-- Giao diện tính năng nhanh dành cho SINH VIÊN thông thường -->
                    <div class="card card-student">
                        <h3>Sự kiện của tôi</h3>
                        <p>Xem danh sách các sự kiện sắp diễn ra và đăng ký tham gia tích hợp điểm rèn luyện.</p>
                        <a href="su-kien.php" class="card-btn">Xem sự kiện</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

</body>
</html>
