<?php
// models/AdminKhuyenMai.php
class KhuyenMai
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Kết nối CSDL
    }

    // Lấy tất cả khuyến mãi
    public function getAllKhuyenMai()
    {
        try {
            $sql = 'SELECT * FROM khuyen_mais';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();   
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn: " . $e->getMessage();
        }
    }

}
 ?>