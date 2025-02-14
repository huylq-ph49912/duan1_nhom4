<?php
class AdminTaiKhoanController
{
    public $modelTaiKhoan;
    public $modelDonHang;
    public $modelSanPham;
    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelSanPham = new AdminSanPham();
    }
    public function danhSachQuanTri()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
        require_once './views/taikhoan/quantri/listQuanTri.php';
    }
    public function fromAddQuanTri()
    {
        // Hiển thị form thêm tài khoản
        require_once './views/taikhoan/quantri/addQuanTri.php';
        deleteSessionError();  // Xóa lỗi cũ trong session
    }
    // Hàm xử lý thêm tài khoản quản trị
    public function postAddQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];

            // Mảng chứa thông báo lỗi
            $errors = [];

            // Kiểm tra nếu họ tên hoặc email bị bỏ trống
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ Tên Không Được Bỏ Trống!';
            }

            if (empty($email)) {
                $errors['email'] = 'Email Không Được Bỏ Trống!';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Kiểm tra email hợp lệ
                $errors['email'] = 'Email Không Hợp Lệ!';
            }

            // Lưu lỗi vào session nếu có
            $_SESSION['error'] = $errors;

            // Nếu không có lỗi, thực hiện thêm tài khoản
            if (empty($errors)) {
                // Mật khẩu mặc định là '123@123ab'
                $password = password_hash('123@123ab', PASSWORD_BCRYPT);
                // Chức vụ là quản trị viên (1)
                $chuc_vu_id = 1;

                // Thêm tài khoản vào cơ sở dữ liệu
                $status = $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);

                if ($status) {
                    // Nếu thêm thành công, chuyển hướng đến trang danh sách tài khoản
                    header('Location:' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                    exit();
                } else {
                    // Nếu thêm thất bại, thêm lỗi vào session và quay lại form thêm tài khoản
                    $_SESSION['error']['email'] = 'Email đã tồn tại!';
                    header('Location:' . BASE_URL_ADMIN . '?act=from-them-quan-tri');
                    exit();
                }
            } else {
                // Nếu có lỗi, hiển thị form thêm tài khoản với thông báo lỗi
                header('Location:' . BASE_URL_ADMIN . '?act=from-them-quan-tri');
                exit();
            }
        }
    }
    public function fromEditQuanTri()
    {
        $id_quan_tri = $_GET['id_quan_tri'];
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        require_once('./views/taikhoan/quantri/editQuanTri.php');
        deleteSessionError();
    }
    public function postEditQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $quan_tri_id = $_POST['quan_tri_id'] ?? '';

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            // Báo lỗi
            $error = [];
            if (empty($ho_ten)) {
                $error['ho_ten'] = 'Họ Tên Không Được Bỏ Trống!';
            }
            if (empty($email)) {
                $error['email'] = 'Email Không Được Bỏ Trống!';
            }
            if (empty($trang_thai)) {
                $error['trang_thai'] = 'Vui Lòng Chọn Trạng Thái!';
            }

            $_SESSION['error'] = $error;

            // Nếu không có lỗi thì tiến hành sửa đơn hàng
            if (empty($error)) {
                $this->modelTaiKhoan->updateTaiKhoan(
                    $quan_tri_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $trang_thai
                );
                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=from-edit-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
            }
        }
    }
    public function resetPassword()
    {
        // Kiểm tra xem `id_quan_tri` hoặc `id_khach_hang` có tồn tại trong URL
        $tai_khoan_id = $_GET['id_quan_tri'] ?? $_GET['id_khach_hang'] ?? null;

        if ($tai_khoan_id) {
            // Lấy thông tin tài khoản từ database
            $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);

            // Kiểm tra nếu tài khoản tồn tại
            if ($tai_khoan) {
                // Đặt lại mật khẩu mặc định là '123@123ab' đã được mã hóa
                $new_password = '123@123ab';
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                // Cập nhật mật khẩu trong cơ sở dữ liệu
                $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $hashed_password);

                if ($status) {
                    // Chuyển hướng theo chuc_vu_id
                    if ($tai_khoan['chuc_vu_id'] == 1) {
                        header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                    } else if ($tai_khoan['chuc_vu_id'] == 2) {
                        header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
                    }
                    exit();
                } else {
                    echo 'Lỗi khi thay đổi mật khẩu!';
                }
            } else {
                echo 'Không tìm thấy tài khoản với ID đã cho!';
            }
        } else {
            echo 'Không tìm thấy ID tài khoản trong URL!';
        }
    }

    public function danhSachKhachHang()
    {
        $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);
        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }
    public function fromEditKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        require_once('./views/taikhoan/khachhang/editKhachHang.php');
        deleteSessionError();
    }
    public function postEditKhachHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $khach_hang_id = $_POST['khach_hang_id'] ?? '';

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            // Báo lỗi
            $error = [];
            if (empty($ho_ten)) {
                $error['ho_ten'] = 'Họ Tên Không Được Bỏ Trống!';
            }
            if (empty($email)) {
                $error['email'] = 'Email Không Được Bỏ Trống!';
            }
            if (empty($ngay_sinh)) {
                $error['ngay_sinh'] = 'Ngày Sinh Không Được Bỏ Trống!';
            }
            if (empty($gioi_tinh)) {
                $error['gioi_tinh'] = 'Giới Tính Không Được Bỏ Trống!';
            }
            if (empty($trang_thai)) {
                $error['trang_thai'] = 'Vui Lòng Chọn Trạng Thái!';
            }

            $_SESSION['error'] = $error;

            // Nếu không có lỗi thì tiến hành sửa đơn hàng
            if (empty($error)) {
                $this->modelTaiKhoan->updateKhachHang(
                    $khach_hang_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $ngay_sinh,
                    $gioi_tinh,
                    $dia_chi,
                    $trang_thai
                );
                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=from-edit-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
        }
    }
    public function deltailKhachHang()
    {
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        // $listDonHang = $this->modelDonHang->getDonHangFromKhachHang($id_khach_hang);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id_khach_hang);
        require_once './views/taikhoan/khachhang/deltailKhachHang.php';
    }
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        unset($_SESSION['errors']); // Xóa thông báo lỗi sau khi hiển thị
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if ($user == $email) { // Đăng nhập thành công
                $_SESSION['user_admin'] = $user;
                header("Location: " . BASE_URL_ADMIN);
                exit();
            } else { // Đăng nhập thất bại, lưu lỗi
                $_SESSION['errors'] = $user;
                header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
                exit();
            }
        }
    }
    public function logout()
    {
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
            exit();
        }
    }
}
?>