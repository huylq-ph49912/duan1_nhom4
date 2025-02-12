<?php
class TinTuc
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Kết nối CSDL
    }

    public function getAllTinTuc()
    {
        try {
            $sql = 'SELECT * FROM tin_tucs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về tất cả tin tức
        } catch (Exception $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return [];
        }
    }

    public function getTinTucById($id)
    {
        try {
            $query = "SELECT * FROM tin_tucs WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về 1 bản ghi
        } catch (Exception $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return null;
        }
    }
}



?>