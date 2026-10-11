<?php
class Database {
    // Cấu hình tài khoản MySQL trên XAMPP máy bạn
    private $host = "localhost";
    private $db_name = "quan_ly_su_kien";
    private $username = "root"; // Mặc định của XAMPP là root
    private $password = "";     // Mặc định của XAMPP là để trống
    public $conn;

    // Hàm kết nối Cơ sở dữ liệu
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Cấu hình định dạng tiếng Việt utf8mb4 để không bị lỗi font
            $this->conn->exec("set names utf8mb4");
            // Thiết lập chế độ báo lỗi nếu có trục trặc trong SQL
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Lỗi kết nối cơ sở dữ liệu: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
