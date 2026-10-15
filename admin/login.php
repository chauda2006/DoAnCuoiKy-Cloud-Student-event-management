<?php
session_start();

// Kiểm tra đường dẫn file database.php
$db_path = '../database.php';
if (file_exists($db_path)) {
    require_once $db_path;
} else {
    die("Không tìm thấy file kết nối database.php ở đường dẫn: " . $db_path);
}

// Kiểm tra xem biến $pdo đã được khởi tạo từ database.php chưa
if (!isset($pdo)) {
    die("Lỗi: Biến kết nối \$pdo chưa được định nghĩa trong file database.php!");
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra mật khẩu (hỗ trợ cả mật khẩu thô và password_hash nếu sau này bạn muốn đổi lại)
        if ($user && ($password === $user['password'] || password_verify($password, $user['password']))) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không chính xác!';
        }
    } else {
        $error = 'Vui lòng nhập đầy đủ thông tin!';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập Quản trị Sự kiện</title>
    <link rel="stylesheet" href="../css/admin-login.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="login-box">
        <h2>Đăng nhập Admin</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Tài khoản</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-submit">Đăng nhập</button>
        </form>
    </div>

    <!-- Script tự động sinh hiệu ứng đốm sáng vũ trụ bay tự do, mờ dần -->
    <script>
        const particleCount = 85;
        const colors = ['#ffffff', '#00ff80', '#ff0055', '#00ccff', '#ffd700'];

        for (let i = 0; i < particleCount; i++) {
            let particle = document.createElement('div');
            particle.classList.add('floating-particle');
            
            particle.style.left = Math.random() * window.innerWidth + 'px';
            particle.style.top = Math.random() * window.innerHeight + 'px';
            
            let size = Math.random() * 2.8 + 1.2;
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            
            particle.style.background = colors[Math.floor(Math.random() * colors.length)];
            particle.style.boxShadow = `0 0 ${Math.random() * 8 + 2}px ${particle.style.background}`;
            
            particle.style.setProperty('--move-x', (Math.random() - 0.5) * 500 + 'px');
            particle.style.setProperty('--move-y', (Math.random() - 0.5) * 500 + 'px');
            
            particle.style.animationDuration = (Math.random() * 7 + 5) + 's';
            particle.style.animationDelay = (Math.random() * 5) + 's';
            
            document.body.appendChild(particle);
        }
    </script>
</body>
</html>