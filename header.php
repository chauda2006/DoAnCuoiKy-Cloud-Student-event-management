<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header class="site-header">
    <div class="header-container">
        
        <!-- GÓC TRÁI SÁT RÌA: GỒM LOGO VÀ TÊN TRANG WEB PHÁT SÁNG -->
        <a href="index.php" class="brand-area">
            <img src="images/logo.png" alt="Logo" class="main-logo">
            <span class="site-title">Student Event Management</span>
        </a>

        <!-- GÓC PHẢI DẠT SANG RÌA: MENU VÀ ĐĂNG XUẤT -->
        <div class="right-header-content">
            <nav class="main-menu">
                <ul>
                    <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Trang chủ</a></li>
                    <li><a href="su-kien.php" class="<?php echo ($current_page == 'su-kien.php') ? 'active' : ''; ?>">Sự kiện</a></li>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <li><a href="quan-ly-sinh-vien.php" class="<?php echo ($current_page == 'quan-ly-sinh-vien.php') ? 'active' : ''; ?>">Quản lý Sinh viên</a></li>
                        <li><a href="thong-ke.php" class="<?php echo ($current_page == 'thong-ke.php') ? 'active' : ''; ?>">Báo cáo/Thống kê</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="user-action">
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="user-name">Chào, <strong><?php echo htmlspecialchars($_SESSION['user']['name']); ?></strong></span>
                    <a href="logout.php" class="btn-logout">Đăng xuất</a>
                <?php else: ?>
                    <a href="login.php" class="btn-login">Đăng nhập</a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</header>
