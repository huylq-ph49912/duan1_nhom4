<?php
class DonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function themDonHang($tai_khoan_id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan_id, $ngay_dat, $ma_don_hang, $trang_thai_id)
    {
        try {
            $sql = 'INSERT INTO don_hangs(tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_nhan, ghi_chu, tong_tien, phuong_thuc_thanh_toan_id, ngay_dat, ma_don_hang, trang_thai_id) 
            VALUES (:tai_khoan_id, :ten_nguoi_nhan, :email_nguoi_nhan, :sdt_nguoi_nhan, :dia_chi_nguoi_nhan, :ghi_chu, :tong_tien, :phuong_thuc_thanh_toan_id, :ngay_dat, :ma_don_hang, :trang_thai_id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':tong_tien' => $tong_tien,
                ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                ':ngay_dat' => $ngay_dat,
                ':ma_don_hang' => $ma_don_hang,
                ':trang_thai_id' => $trang_thai_id
            ]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn" . $e->getMessage();
        }
    }
    public function themChiTietDonHang($cart, $order_id, $tai_khoan_id)
    {
        foreach ($cart as $item) {
            // Lấy giá sản phẩm từ bảng san_phams
            $sql = "SELECT gia_san_pham FROM san_phams WHERE id = :sanPhamId";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':sanPhamId' => $item['san_pham_id']]);
            $giaSanPham = $stmt->fetchColumn();

            if (!$giaSanPham) {
                throw new Exception("Không tìm thấy giá sản phẩm với ID: " . $item['san_pham_id']);
            }

            // Chèn dữ liệu vào bảng chi_tiet_don_hang
            $sqlInsert = "INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, don_gia, so_luong, tai_khoan_id) 
                          VALUES (:donHangId, :sanPhamId, :donGia, :soLuong, :taiKhoanId)";
            $stmtInsert = $this->conn->prepare($sqlInsert);
            $stmtInsert->execute([
                ':donHangId' => $order_id,
                ':sanPhamId' => $item['san_pham_id'],
                ':donGia' => $giaSanPham,
                ':soLuong' => $item['so_luong'],
                ':taiKhoanId' => $tai_khoan_id  // Đảm bảo rằng tai_khoan_id được truyền vào
            ]);
        }
    }

    public function getDonHangFormUser($taiKhoanId)
    {
        try {
            // Modify the SQL query to order by the id in descending order (most recent id first)
            $sql = "SELECT * FROM don_hangs WHERE tai_khoan_id = :tai_khoan_id ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id' => $taiKhoanId,
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Lỗi truy vấn: ' . $e->getMessage();
        }
    }

    public function getTrangThaiDonHang()
    {
        try {
            $sql = "SELECT * FROM trang_thai_don_hang ";


            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Lỗi truy vấn' . $e->getMessage();
        }
    }

    public function getPhuongThucThanhToan()
    {
        try {
            $sql = "SELECT * FROM phuong_thuc_thanh_toan";


            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Lỗi truy vấn' . $e->getMessage();
        }
    }

    public function getDonHangById($donHangId)
    {
        try {
            $sql = "SELECT * FROM don_hangs WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $donHangId]); // sửa cú pháp ở đây

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Lỗi truy vấn: ' . $e->getMessage();
        }
    }
    public function getChiTietDonHangByDonHangId($donHangId)
    {
        try {
            $sql = "SELECT 
            chi_tiet_don_hangs.*,
            san_phams.ten_san_pham,
            san_phams.hinh_anh
            FROM chi_tiet_don_hangs JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
            WHERE chi_tiet_don_hangs.don_hang_id = :don_hang_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':don_hang_id' => $donHangId]); // sửa cú pháp ở đây

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo 'Lỗi truy vấn: ' . $e->getMessage();
        }
    }
    public function updateTrangThaiDonHang($donHangId, $trangThaiId)
    {
        try {
            $sql = "UPDATE don_hangs SET trang_thai_id = :trangThaiId WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $donHangId, ':trangThaiId' => $trangThaiId]); // truyền tham số đúng

        } catch (Exception $e) {
            echo 'Lỗi truy vấn: ' . $e->getMessage();
        }
    }

}
?>