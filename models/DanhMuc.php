<?php
class AdminDanhMuc
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDanhMuc()
    {
        try {
            $sql = 'SELECT * FROM danh_mucs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng kết quả
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn:" . $e->getMessage();
        }
    }
    
    // Lấy danh mục theo ID
    public function getDanhMucById($id)
    {
        try {
            $sql = "SELECT * FROM danh_mucs WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về 1 dòng kết quả
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn:" . $e->getMessage();
        }
    }
    
    // Lấy sản phẩm theo danh mục
    public function getSanPhamByDanhMuc($danhMucId)
    {
        try {
            $sql = "SELECT * FROM san_phams WHERE danh_muc_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$danhMucId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng các sản phẩm thuộc danh mục
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn:" . $e->getMessage();
        }
    }
}
?>