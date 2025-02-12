<?php
class GioHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getGioHangFormUser($id)
    {
        try {
            $sql = 'SELECT * FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn" . $e->getMessage();
        }
    }
    public function getChiTietGioHang($id)
    {
        try {
            $sql = 'SELECT chi_tiet_gio_hangs. *, san_phams.ten_san_pham, san_phams.hinh_anh, san_phams.gia_khuyen_mai, san_phams.gia_san_pham,san_phams.so_luong AS ton_kho
                    FROM chi_tiet_gio_hangs 
                    INNER JOIN san_phams ON chi_tiet_gio_hangs.san_pham_id = san_phams.id
                    WHERE chi_tiet_gio_hangs.gio_hang_id = :gio_hang_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn" . $e->getMessage();
        }
    }
    public function themGioHang($id)
    {
        try {
            $sql = 'INSERT INTO gio_hangs(tai_khoan_id) VALUES(:id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn" . $e->getMessage();
        }
    }
    public function updateSoLuong($gio_hang_id, $san_pham_id, $so_luong)
    {
        try {
            $sql = 'UPDATE chi_tiet_gio_hangs 
            SET so_luong = :so_luong 
            WHERE gio_hang_id = :gio_hang_id 
            AND san_pham_id = :san_pham_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $gio_hang_id, ':san_pham_id' => $san_pham_id, ':so_luong' => $so_luong]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn" . $e->getMessage();
        }
    }
    public function addChiTietGioHang($gio_hang_id, $san_pham_id, $so_luong)
    {
        try {
            $sql = 'INSERT INTO chi_tiet_gio_hangs(gio_hang_id, san_pham_id, so_luong) 
            VALUES(:gio_hang_id, :san_pham_id, :so_luong)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $gio_hang_id, ':san_pham_id' => $san_pham_id, ':so_luong' => $so_luong]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn" . $e->getMessage();
        }
    }
    public function themDonHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin đơn hàng từ form
            $tai_khoan_id = $_POST['tai_khoan_id'];
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
            $ngay_dat = date('Y-m-d H:i:s');
            $ma_don_hang = uniqid('DH'); // Tạo mã đơn hàng ngẫu nhiên
            $trang_thai_id = 1; // Mặc định trạng thái là "Đang chờ xác nhận"

            // Gọi phương thức thêm đơn hàng vào model
            $donHangId = $this->modelDonHang->themDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $tong_tien,
                $phuong_thuc_thanh_toan_id,
                $ngay_dat,
                $ma_don_hang,
                $trang_thai_id
            );

            if ($donHangId) {
                // Thêm chi tiết đơn hàng sau khi tạo đơn
                foreach ($_SESSION['gio_hang'] as $item) {
                    $item['don_hang_id'] = $donHangId; // Gắn ID đơn hàng vào chi tiết
                    $this->modelDonHang->themChiTietDonHang($item); // Thêm chi tiết đơn hàng vào model
                }


                // Xóa giỏ hàng sau khi đặt hàng thành công
                unset($_SESSION['gio_hang']);

                $_SESSION['success'] = 'Đặt hàng thành công!';
                header("Location: " . BASE_URL . '?act=order-success');
                exit();
            } else {
                $_SESSION['errors'] = 'Có lỗi xảy ra, vui lòng thử lại!';
                header("Location: " . BASE_URL . '?act=order');
                exit();
            }
        }
    }
    public function deleteGioHang($gio_hang_id)
    {
        try {
            $sql = 'DELETE FROM gio_hangs WHERE id = :gio_hang_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':gio_hang_id' => $gio_hang_id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn" . $e->getMessage();
        }
    }
}
?>