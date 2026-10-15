<?php
session_start();
require_once '../database.php';

// Khởi tạo biến thông báo lỗi mặc định là rỗng để tránh warning
$error = '';

// Xử lý đăng nhập truyền thống (Form POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = 'Vui lòng nhập đầy đủ thông tin!';
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không đúng!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Người dùng</title>
    <!-- Tái sử dụng file CSS dùng chung với register.php -->
    <link rel="stylesheet" href="../css/user-login.css">
</head>
<body>

    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-header">
                <h2>ĐĂNG NHẬP</h2>
                <p>Cổng thông tin tài khoản người dùng</p>
            </div>

            <!-- Khung thông báo lỗi (chỉ hiện khi biến $error có nội dung) -->
            <?php if (!empty($error)): ?>
                <div class="error-msg"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="divider">
                <span>hoặc đăng nhập bằng tài khoản</span>
            </div>

            <!-- FORM ĐĂNG NHẬP TRUYỀN THỐNG -->
            <form method="POST" action="login.php" class="login-form">
                <div class="input-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="input-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn-submit">Đăng nhập</button>
            </form>

            <div class="login-footer">
                <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>

</body>
</html>