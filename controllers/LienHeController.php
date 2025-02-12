<?php

require_once './models/LienHe.php';

class LienHeController {
    private $model;

    public function __construct() {
        $db = connectDB(); // Kết nối database (hàm connectDB() có trong `commons/function.php`)
        $this->model = new LienHeModel($db);
    }

    // Hiển thị form liên hệ
    public function formLienHe() {
        require_once './views/LienHe/FormLienHe.php';
    }

    // Xử lý gửi liên hệ
    public function guiLienHe() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $ten_lien_he = $_POST['ten_lien_he'] ?? '';
            $email = $_POST['email'] ?? '';
            $thong_tin = $_POST['thong_tin'] ?? '';
            $trang_thai = 0; // Mặc định trạng thái là 0 (chưa xử lý)

            // Kiểm tra dữ liệu nhập vào
            if (empty($ten_lien_he) || empty($email) || empty($thong_tin)) {
                $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin!";
                header('Location: index.php?act=lien-he');
                exit;
            }

            // Thêm vào database
            $ket_qua = $this->model->themLienHe($ten_lien_he, $email, $thong_tin, $trang_thai);

            if ($ket_qua) {
                $_SESSION['message'] = "Gửi liên hệ thành công!";
            } else {
                $_SESSION['message'] = "Gửi liên hệ thất bại. Vui lòng thử lại!";
            }

            // Quay lại trang liên hệ
            header('Location: index.php?act=lien-he');
            exit;
        }
    }
}
?>
