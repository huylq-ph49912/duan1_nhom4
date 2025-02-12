<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/KhuyenMaiController.php';
require_once './controllers/LienHeController.php';
require_once './controllers/TinTucController.php';
require_once './controllers/SanPhamController.php';

// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/Banner.php';
require_once './models/KhuyenMai.php';
require_once './models/LienHe.php';
require_once './models/TinTuc.php';
require_once './models/GioHang.php';
require_once './models/DonHang.php';
require_once './models/BinhLuan.php';
// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->home(),
    // Giới thiệu
    'gioi-thieu' => (new HomeController())->GioiThieu(),
    // Đăng Nhập, Đăng ký
    'login' => (new HomeController())->formlogin(),
    'check-login' => (new HomeController())->postLogin(),
    'register' => (new HomeController())->formRegister(),
    'check-register' => (new HomeController())->postRegister(),
    'logout-clinet' => (new HomeController())->Logout(),
    // Thay đổi thông tin cá nhân
    'form-sua-thong-tin' => (new HomeController())->formEditCaNhan(),
    'sua-thong-tin' => (new HomeController())->postEditCaNhan(),
    // Đổi mật khẩu
    'doi-mat-khau' => (new HomeController())->formDoiMatKhau(), 
    'sua-mat-khau' => (new HomeController())->postDoiMatKhau(),
    //khuyễn mãi
    'khuyen-mai' => (new KhuyenMaiController())->danhSachKhuyenMai(),
    // Trang liên hệ
    'lien-he' => (new LienHeController())->formLienHe(),
    'gui-lien-he' => (new LienHeController())->guiLienHe(),
    //tin tức
    'tin-tuc' => (new TinTucController())->danhSachTinTuc(),
    // 'detail-tin-tuc' => (new TinTucController())->danhSachTinTuc(),
    'chiTietTinTuc' => (new TinTucController())->chiTietTinTuc($_GET['id'] ?? null),
    // Rout Chi tiết sản phẩm
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),
    // Thêm Giỏ Hàng
    'them-gio-hang' => (new HomeController())->themGioHang(),
    'gio-hang' => (new HomeController())->gioHang(),
    // Thanh Toán
    'thanh-toan' => (new HomeController())->thanhToan(),
    'xu-ly-thanh-toan' => (new HomeController())->postThanhToan(),
    'lich-su-mua-hang' => (new HomeController())->lichSuMuaHang(),
    'chi-tiet-mua-hang' => (new HomeController())->chiTietMuaHang(),
    'huy-don-hang' => (new HomeController())->huyDonHang(),
    'san-pham-theo-danh-muc' => (new SanPhamController())->sanPhamTheoDanhMuc($_GET['id_danh_muc'] ?? null), // Thêm route cho sản phẩm theo danh mục
    'san-pham' => (new SanPhamController())->tatCaSanPham(),
    'xac-nhan-nhan-hang' => (new HomeController())->lichSuMuaHang(),
    // Tìm kiếm 
    'tim-kiem' => (new HomeController())->timKiemSanPham(),
};
?>