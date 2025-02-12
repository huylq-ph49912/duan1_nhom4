<?php
class AdminBanner
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Kết nối cơ sở dữ liệu
    }

    // Lấy tất cả banner từ cơ sở dữ liệu
    public function getAllBanners()
    {
        try {
            $sql = 'SELECT * FROM banners';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn: " . $e->getMessage();
            return false;
        }
    }
}
?>