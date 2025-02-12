<?php
class AdminDanhMuc{
    public $conn;
    public function __construct(){
        $this -> conn = connectDB();
    }
    public function getAllDanhMuc(){
        $sql = 'SELECT * FROM danh_mucs';
        $stmt = $this->conn->prepare($sql);
        $stmt -> execute();
        return $stmt->fetchAll();
    }
    // Thêm Danh Mục
    public function insertDanhMuc($ten_danh_muc, $mo_ta, $hinh_anh)
    {
        try {
            $sql = 'INSERT INTO danh_mucs (ten_danh_muc, mo_ta, hinh_anh) VALUES (:ten_danh_muc, :mo_ta, :hinh_anh)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn:" . $e->getMessage();
        }
    }
    // Lấy Chi Tiết Danh Mục
    public function getDetailDanhMuc($id)
    {
        try {
            $sql = 'SELECT * FROM danh_mucs WHERE id=:id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn:" . $e->getMessage();
        }
    }
    // Cập Nhật Danh Mục
    public function updateDanhMuc($id, $ten_danh_muc, $mo_ta, $hinh_anh = null)
    {
        try {
            if ($hinh_anh) {
                $sql = 'UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta, hinh_anh = :hinh_anh WHERE id = :id';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ':ten_danh_muc' => $ten_danh_muc,
                    ':mo_ta' => $mo_ta,
                    ':hinh_anh' => $hinh_anh,
                    ':id' => $id
                ]);
            } else {
                $sql = 'UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta WHERE id = :id';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ':ten_danh_muc' => $ten_danh_muc,
                    ':mo_ta' => $mo_ta,
                    ':id' => $id
                ]);
            }
            return true;
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn:" . $e->getMessage();
        }
    }
     // Xóa Danh Mục
     public function destroyDanhMuc($id)
     {
         try {
             // Lấy hình ảnh từ danh mục
             $sql = 'SELECT hinh_anh FROM danh_mucs WHERE id = :id';
             $stmt = $this->conn->prepare($sql);
             $stmt->execute([':id' => $id]);
             $danhMuc = $stmt->fetch();
 
             // Xóa file hình ảnh nếu có
             if ($danhMuc) {
                 $imagePath = './uploads/' . $danhMuc['hinh_anh'];
                 if (file_exists($imagePath)) {
                     unlink($imagePath);
                 }
                 // Xóa danh mục khỏi cơ sở dữ liệu
                 $sql = 'DELETE FROM danh_mucs WHERE id = :id';
                 $stmt = $this->conn->prepare($sql);
                 $stmt->execute([':id' => $id]);
             }
         } catch (Exception $e) {
             echo "Lỗi Truy Vấn:" . $e->getMessage();
         }
     }
}

?>