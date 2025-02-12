<?php
class BinhLuan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Kết nối cơ sở dữ liệu
    }

    // Thêm bình luận
    public function themBinhLuan($san_pham_id, $user_email, $noi_dung)
    {
        try {
            // Lấy ID người dùng từ email
            $sqlUser = 'SELECT id FROM tai_khoans WHERE email = :email';
            $stmtUser = $this->conn->prepare($sqlUser);
            $stmtUser->execute([':email' => $user_email]);
            $user = $stmtUser->fetch();

            if (!$user) {
                return "Người dùng không tồn tại.";
            }

            // Lấy ID người dùng
            $nguoi_dung_id = $user['id'];

            // Thêm bình luận vào bảng binh_luans
            $sql = 'INSERT INTO binh_luan (san_pham_id, nguoi_dung_id, noi_dung) VALUES (:san_pham_id, :nguoi_dung_id, :noi_dung)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':nguoi_dung_id' => $nguoi_dung_id,
                ':noi_dung' => $noi_dung
            ]);

            return true; // Thêm bình luận thành công
        } catch (Exception $e) {
            return 'Lỗi hệ thống: ' . $e->getMessage();
        }
    }

    // Lấy bình luận theo sản phẩm
    public function layBinhLuanTheoSanPham($san_pham_id)
    {
        try {
            $sql = 'SELECT binh_luan.*, tai_khoans.ho_ten FROM binh_luan 
                    JOIN tai_khoans ON binh_luan.nguoi_dung_id = tai_khoans.id
                    WHERE san_pham_id = :san_pham_id 
                    ORDER BY binh_luan.created_at DESC';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':san_pham_id' => $san_pham_id]);
            return $stmt->fetchAll(); // Trả về danh sách bình luận
        } catch (Exception $e) {
            return 'Lỗi hệ thống: ' . $e->getMessage();
        }
    }
}
?>
