<?php
require_once('./models/SanPham.php');
require_once('./models/TaiKhoan.php');
require_once('./models/Banner.php');
require_once('./models/DanhMuc.php');
require_once('./models/TinTuc.php');
require_once('./models/GioHang.php');
require_once('./models/BinhLuan.php');

class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelBanner;
    public $modelDanhMuc;
    public $TinTuc;
    public $modelDonHang;
    public $modelGioHang;
    public $conn; // Thêm thuộc tính $conn
    public function __construct()
    {
        // Khởi tạo các model
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelBanner = new AdminBanner();
        $this->modelDanhMuc = new AdminDanhMuc();
        $this->TinTuc = new TinTuc();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();

        // Khởi tạo kết nối cơ sở dữ liệu
        $this->conn = new PDO("mysql:host=localhost;dbname=du_an_1", "root", ""); // Thay đổi thông tin nếu cần
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    // Phương thức hiển thị trang chủ
    public function home()
    {
        // Get data for homepage
        $listSanPham = $this->modelSanPham->getAllSanPham(); // Lấy danh sách sản phẩm
        $listBanner = $this->modelBanner->getAllBanners(); // Lấy danh sách banner từ database
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc(); // Lấy danh sách danh mục từ database
        $listTinTuc = $this->TinTuc->getAllTinTuc(); // Get list of news articles

        // Pass data to the view
        require_once('./views/home.php'); // Truyền dữ liệu sang view home.php
    }
    public function sanPhamTheoDanhMuc($danhMucId)
    {
        // Lấy thông tin danh mục
        $danhMuc = $this->modelDanhMuc->getDanhMucById($danhMucId);
        // Lấy các sản phẩm thuộc danh mục
        $listSanPham = $this->modelDanhMuc->getSanPhamByDanhMuc($danhMucId);

        // Truyền dữ liệu sang view
        require_once('./views/sanPhamTheoDanhMuc.php');
    }
    // Trang giới thiệu
    public function GioiThieu()
    {
        require_once('./views/gioithieu.php');
    }
    // Hiển thị form đăng nhập
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        unset($_SESSION['errors']); // Xóa thông báo lỗi sau khi hiển thị
    }
    // Xử lý đăng nhập
    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if ($user == $email) { // Đăng nhập thành công
                $_SESSION['user_clinet'] = $user;
                header("Location: " . BASE_URL);
                exit();
            } else { // Đăng nhập thất bại, lưu lỗi
                $_SESSION['errors'] = $user;
                header("Location: " . BASE_URL . '?act=login');
                exit();
            }
        }
    }
    // Hiển thị form đăng ký
    public function formRegister()
    {
        require_once './views/auth/formRegister.php'; // Truyền đến view đăng ký
    }
    // Xử lý đăng ký
    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $dia_chi = $_POST['dia_chi'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Kiểm tra giới tính chỉ có "Nam" hoặc "Nữ"
            if (!in_array($gioi_tinh, ['Nam', 'Nữ'])) {
                $_SESSION['errors'] = 'Giới tính không hợp lệ. Vui lòng chọn Nam hoặc Nữ.';
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }

            // Kiểm tra ngày sinh phải trước năm hiện tại
            $currentYear = date("Y");
            $birthYear = date("Y", strtotime($ngay_sinh));
            if ($birthYear >= $currentYear) {
                $_SESSION['errors'] = 'Ngày sinh không hợp lệ. Vui lòng chọn năm trước năm hiện tại.';
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }

            // Kiểm tra mật khẩu và xác nhận mật khẩu có khớp không
            if ($password !== $confirm_password) {
                $_SESSION['errors'] = 'Mật khẩu và xác nhận mật khẩu không khớp.';
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }

            // Gọi phương thức từ Model để xử lý đăng ký
            $result = $this->modelTaiKhoan->registerUser(
                $ho_ten,
                $ngay_sinh,
                $so_dien_thoai,
                $gioi_tinh,
                $dia_chi,
                $email,
                $password
            );

            if ($result === true) { // Đăng ký thành công
                $_SESSION['register_success'] = 'Đăng ký thành công. Vui lòng đăng nhập!';
                header("Location: " . BASE_URL . '?act=login');
                exit();
            } else { // Thông báo lỗi nếu có
                $_SESSION['errors'] = $result;
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }
        }
    }
    // Xử lý đăng xuất
    public function Logout()
    {
        if (isset($_SESSION['user_clinet'])) {
            unset($_SESSION['user_clinet']);
            header("Location: " . BASE_URL . '?act=/');
            exit();
        }
        if (isset($_SESSION['ho_ten'])) {
            unset($_SESSION['ho_ten']);
            header("Location: " . BASE_URL . '?act=/');
            exit();
        }
    }
    // Thay đổi thông tin cá nhân
    public function formEditCaNhan()
    {
        if (isset($_SESSION['user_clinet'])) {
            $email = $_SESSION['user_clinet']; // Lấy email người dùng từ session
            $thongTin = $this->modelTaiKhoan->getTaiKhoanformEmail($email); // Lấy thông tin người dùng
            require_once './views/auth/fromEditCaNhan.php'; // Truyền thông tin vào view
        } else {
            // Nếu người dùng chưa đăng nhập, chuyển về trang đăng nhập
            header("Location: " . BASE_URL . "?act=login");
            exit();
        }
    }
    // Xử lý thay đổi thông tin cá nhân
    public function postEditCaNhan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $ho_ten = $_POST['ho_ten'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $dia_chi = $_POST['dia_chi'];
            $email = $_SESSION['user_clinet'];  // Email của người dùng đã đăng nhập

            // Cập nhật thông tin người dùng (không thay đổi mật khẩu)
            $result = $this->modelTaiKhoan->updateUserInfo(
                $ho_ten,
                $ngay_sinh,
                $so_dien_thoai,
                $gioi_tinh,
                $dia_chi,
                $email
            );

            if ($result) {
                // Cập nhật thành công
                $_SESSION['success'] = 'Cập nhật thông tin thành công!';
                header("Location: " . BASE_URL . '/');
            } else {
                // Cập nhật thất bại
                $_SESSION['errors'] = 'Cập nhật không thành công! Vui lòng kiểm tra lại dữ liệu.';
                header("Location: " . BASE_URL . '/?act=form-sua-thong-tin');
            }
            exit();
        }
    }
    // Hiển thị form đổi mật khẩu
    public function formDoiMatKhau()
    {
        require_once './views/auth/formDoiMatKhau.php';
    }
    // Xử lý đổi mật khẩu
    public function postDoiMatKhau()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_SESSION['user_clinet']; // Lấy email từ session
            $oldPassword = $_POST['old_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Kiểm tra mật khẩu mới và xác nhận khớp
            if ($newPassword !== $confirmPassword) {
                $_SESSION['errors'] = 'Mật khẩu mới không khớp!';
                header("Location: " . BASE_URL . '?act=doi-mat-khau');
                exit();
            }

            // Gọi phương thức đổi mật khẩu từ model
            $result = $this->modelTaiKhoan->changePassword($email, $oldPassword, $newPassword);

            if ($result === true) {
                $_SESSION['success'] = 'Đổi mật khẩu thành công!';
                header("Location: " . BASE_URL . '/');
            } else {
                $_SESSION['errors'] = $result;
                header("Location: " . BASE_URL . '?act=doi-mat-khau');
            }
            exit();
        }
    }
    // Chi Tiết
    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);
        // var_dump($listSanPhamCungDanhMuc);die;
        if ($sanPham) {
            require_once('./views/detailSanPham.php');
        } else {
            header('Location:' . BASE_URL);
            exit();
        }
    }
    // Thêm Giỏ Hàng
    public function themGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_clinet'])) {
                $mail = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_clinet']);
                $gioHang = $this->modelGioHang->getGioHangFormUser($mail['id']);
                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->themGioHang($mail['id']);
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getChiTietGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->getChiTietGioHang($gioHang['id']);
                }
                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];
                $checkSanPham = false;
                $isQuantity = false;
                $error = '';
                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $product = $this->modelSanPham->getDetailSanPham($detail['san_pham_id']);
                        $newSoLuong = $detail['so_luong'] + $so_luong;
                        $checkSanPham = true;
                        if ($newSoLuong > $product['so_luong']) {
                            $error = "Số lượng sản phẩm trong giỏ hàng quá giới hạn";
                            $isQuantity = true;
                            break;
                        } else {
                            $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                            break;

                        }
                    }
                }
                if (!$checkSanPham) {
                    $this->modelGioHang->addChiTietGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }

                if ($isQuantity) {
                    header("Location: " . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                } else {
                    header("Location: " . BASE_URL . '?act=gio-hang');
                }
            } else {
                // Hiển thị lỗi và chuyển hướng đến trang đăng nhập
                $_SESSION['errors'] = 'Bạn cần đăng nhập hoặc đăng ký để thêm sản phẩm vào giỏ hàng.';
                header("Location: " . BASE_URL . '?act=login');
                exit();
            }
        }
    }
    public function gioHang()
    {
        if (isset($_SESSION['user_clinet'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_clinet']);
            $gioHang = $this->modelGioHang->getGioHangFormUser($mail['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->themGioHang($mail['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getChiTietGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getChiTietGioHang($gioHang['id']);
            }
            require_once('./views/giohang/gioHang.php');
        } else {
            // Hiển thị lỗi và chuyển hướng đến trang đăng nhập
            $_SESSION['errors'] = 'Bạn cần đăng nhập hoặc đăng ký để thêm sản phẩm vào giỏ hàng.';
            header("Location: " . BASE_URL . '?act=login');
            exit();
        }
    }
    // Thanh Toán 
    public function thanhToan()
    {
        if (isset($_SESSION['user_clinet'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_clinet']);
            $gioHang = $this->modelGioHang->getGioHangFormUser($user['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->themGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getChiTietGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getChiTietGioHang($gioHang['id']);
            }
            require_once('./views/giohang/thanhToan.php');
        } else {
            // Hiển thị lỗi và chuyển hướng đến trang đăng nhập
            $_SESSION['errors'] = 'Bạn cần đăng nhập hoặc đăng ký để thêm sản phẩm vào giỏ hàng.';
            header("Location: " . BASE_URL . '?act=login');
            exit();
        }
    }
    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = isset($_POST['phuong_thuc_thanh_toan_id']) ? $_POST['phuong_thuc_thanh_toan_id'] : 1; // Giá trị mặc định là 1
            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1;

            // Lấy thông tin tài khoản
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_clinet']);
            $tai_khoan_id = $user['id'];
            $ma_don_hang = 'DH' . rand(1000, 9999);

            $cart_id = $_POST["gio_hang_id"];
            $cart = $this->modelGioHang->getChiTietGioHang(id: $cart_id);

            $order_id = $this->modelDonHang->themDonHang(
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
            $this->modelDonHang->themChiTietDonHang($cart, $order_id, $tai_khoan_id);
            $this->modelGioHang->deleteGioHang($cart_id);
            // Lưu thông báo thành công vào session
            $_SESSION['success_message'] = "Chúc mừng bạn đã đặt hàng thành công!";
            header('Location: ' . BASE_URL . "?act=lich-su-mua-hang"); // Chuyển hướng về trang chủ
            exit();
        }
    }
    // Quản Lý Đơn Hàng
    public function lichSuMuaHang()
    {
        if (isset($_SESSION['user_clinet'])) {
            // Lấy thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_clinet']);
            $tai_khoan_id = $user['id'];

            // Lấy danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai');
            $trangThaiDonHang = array_combine(
                range(1, count($trangThaiDonHang)),
                $trangThaiDonHang
            );

            // Lấy danh sách phương thức thanh toán
            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc');
            $phuongThucThanhToan = array_combine(
                range(1, count($phuongThucThanhToan)),
                $phuongThucThanhToan
            );

            // Xử lý cập nhật trạng thái đơn hàng khi xác nhận "Đã nhận hàng"
            if (isset($_GET['act']) && $_GET['act'] == 'xac-nhan-nhan-hang') {
                $id = $_GET['id'];
                // Cập nhật trạng thái đơn hàng thành "Giao hàng thành công" (trạng thái ID = 5)
                $sql = "UPDATE don_hangs SET trang_thai_id = 5 WHERE id = :id"; // Trạng thái ID = 5 là "Giao hàng thành công"
                $stmt = $this->conn->prepare($sql);
                $stmt->execute(['id' => $id]);


                // Chuyển hướng về trang lịch sử mua hàng
                $return_url = $_GET['return_url'] ?? BASE_URL . '?act=lich-su-mua-hang';
                header("Location: $return_url");
                exit();
            }

            // Lấy danh sách đơn hàng của người dùng
            $donHangs = $this->modelDonHang->getDonHangFormUser($tai_khoan_id);
            require_once('./views/lichSuMuaHang.php');

        } else {
            var_dump('Bạn chưa đăng nhập');
        }
    }
    public function huyDonHang()
    {
        if (isset($_SESSION['user_clinet'])) {
            // Lấy thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_clinet']);
            $tai_khoan_id = $user['id'];

            // Lấy ID đơn hàng từ URL
            if (!isset($_GET['id'])) {
                echo "Không tìm thấy đơn hàng!";
                exit();
            }

            $donHangId = $_GET['id'];

            // Lấy thông tin đơn hàng từ CSDL
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            // Kiểm tra quyền sở hữu đơn hàng
            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Không phải đơn hàng của bạn";
                exit();
            }

            // Kiểm tra trạng thái đơn hàng, chỉ cho phép hủy nếu trạng thái là 'Đang chờ xử lý' (1)
            if ($donHang['trang_thai_id'] != 1) {
                echo "<script>
                    alert('Không thể hủy đơn hàng vì đã được xử lý!');
                    window.location.href = '" . BASE_URL . "?act=lich-su-mua-hang';
                </script>";
                return;
            }

            // Cập nhật trạng thái đơn hàng sang 'Đã hủy' (7)
            $this->modelDonHang->updateTrangThaiDonHang($donHangId, 7);

            // Điều hướng về trang trước hoặc danh sách đơn hàng
            $returnUrl = isset($_GET['return_url']) ? $_GET['return_url'] : BASE_URL . "?act=danh-sach-don-hang";
            header("Location: " . $returnUrl);
            exit();
        } else {
            echo "Bạn chưa đăng nhập!";
            exit();
        }
    }
    public function chiTietMuaHang()
    {
        if (isset($_SESSION['user_clinet'])) {
            // lấy thông tin tài khoatn đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_clinet']);
            $tai_khoan_id = $user['id'];
            $donHangId = $_GET['id'];

            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai');

            $trangThaiDonHang = array_combine(
                range(1, count($trangThaiDonHang)),
                $trangThaiDonHang
            );

            //lấy ra danh sáchphương thức  thanh toá
            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, column_key: 'ten_phuong_thuc');
            $phuongThucThanhToan = array_combine(
                range(1, count($phuongThucThanhToan)),
                $phuongThucThanhToan
            );

            //lấy ra thông tin đon hàng theo id

            $donHangs = $this->modelDonHang->getDonHangById($donHangId);


            //lấy thông tin sản phẩm đon ưhang trong bảng chi tiết đơn hàng
            $chiTietDonHangs = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);

            // echo'<pre>';
            // var_dump($donHangs);
            // // var_dump($chiTietDonHangs);
            // echo'</pre>';
            if ($donHangs['tai_khoan_id'] != $tai_khoan_id) {
                echo 'khong phai don hang cua ban';
                exit();
            }
            require_once('./views/chiTietMuaHang.php');
        } else {
            var_dump('Bạn chưa đăng nhập');
        }
    }
    // Lọc tìm kiếm
    public function timKiemSanPham()
    {
        // Lấy các tham số từ GET
        $danhMuc = $_GET['danh_muc'] ?? 'all';
        $mucGia = $_GET['muc_gia'] ?? 'all';
        $sapXep = $_GET['sap_xep'] ?? 'asc';

        // Gọi model để lấy danh sách sản phẩm
        $listSanPham = $this->modelSanPham->getProductInSearch(null, $danhMuc, $mucGia, $sapXep);

        // Lấy danh sách danh mục để hiển thị lại form
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        // Render giao diện với kết quả tìm kiếm
        require_once './views/all.php';
    }
}
?>