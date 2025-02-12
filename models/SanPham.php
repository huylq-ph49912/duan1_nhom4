<?php
class SanPham
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Kết nối đến cơ sở dữ liệu
    }
    // Lấy tất cả sản phẩm kèm theo tên danh mục
    public function getAllSanPham()
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
                    FROM san_phams 
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng kết quả
        } catch (Exception $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return []; // Trả về mảng rỗng nếu có lỗi
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
            echo "Lỗi truy vấn: " . $e->getMessage();
            return []; // Trả về mảng rỗng nếu có lỗi
        }
    }
    // Lấy chi tiết sản phẩm
    public function getDetailSanPham($id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
                    FROM san_phams 
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE san_phams.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về chi tiết sản phẩm
        } catch (Exception $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return null; // Trả về null nếu có lỗi
        }
    }
    // Lấy danh sách ảnh sản phẩm
    public function getListAnhSanPham($id)
    {
        try {
            $sql = 'SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng các ảnh
        } catch (Exception $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return []; // Trả về mảng rỗng nếu có lỗi
        }
    }
    // Lấy danh sách sản phẩm theo danh mục
    public function getListSanPhamDanhMuc($danh_muc_id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
                    FROM san_phams 
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE san_phams.danh_muc_id = :danh_muc_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':danh_muc_id' => $danh_muc_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng các sản phẩm thuộc danh mục
        } catch (Exception $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return []; // Trả về mảng rỗng nếu có lỗi
        }
    }
    // Lọc
    public function getProductInSearch($key, $id_category, $price_range, $sort)
    {
        $sql = "SELECT * FROM san_phams WHERE 1=1";

        // Lọc theo danh mục
        if ($id_category && $id_category !== 'all') {
            $sql .= " AND danh_muc_id = :id_category";
        }

        // Lọc theo mức giá
        if ($price_range && $price_range !== 'all') {
            [$minPrice, $maxPrice] = explode('-', $price_range);
            $sql .= " AND gia_san_pham BETWEEN :minPrice AND :maxPrice";
        }
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($sql);

        // Gắn giá trị cho các tham số
        if ($id_category && $id_category !== 'all') {
            $stmt->bindParam(':id_category', $id_category, PDO::PARAM_INT);
        }
        if ($price_range && $price_range !== 'all') {
            $stmt->bindParam(':minPrice', $minPrice, PDO::PARAM_INT);
            $stmt->bindParam(':maxPrice', $maxPrice, PDO::PARAM_INT);
        }

        // Thực thi và trả kết quả
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllDanhMuc()
    {
        try {
            $sql = 'SELECT * FROM danh_mucs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            // Log error to a file instead of displaying it directly
            error_log('Lỗi: ' . $e->getMessage());
            return false;
        }
    }
}
?>