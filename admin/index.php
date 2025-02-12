<?php 
session_start();

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers

// require_once 'controllers/DashboardController.php';
require_once 'controllers/AdminSanPhamController.php';
require_once 'controllers/AdminDanhMucController.php';
require_once './controllers/AdminDonHangController.php';

// Require toàn bộ file Models
require_once 'models/AdminSanPham.php';
require_once 'models/AdminDanhMuc.php';
require_once './models/AdminDonHang.php';

// require_once 'controllers/DashboardController.php';

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Dashboards

    '/'                 => (new DashboardController())->index(),
    // San Pham
    'san-pham'         => (new AdminSanPhamController())->danhSachSanPham(),
    'from-them-san-pham' => (new AdminSanPhamController())->fromAddSanPham(),

    // Rout Đơn Hàng
    'don-hang' => (new AdminDonHangController())->danhSachDonHang(),// Hiển Thị 
    'from-edit-don-hang' => (new AdminDonHangController())->fromEditDonHang($_GET['id']),// Sửa
    'edit-don-hang' => (new AdminDonHangController())->capNhatDonHang(),
    'detail-don-hang' => (new AdminDonHangController())->detailDonHang(),
    'chi-tiet-don-hang' => (new AdminDonHangController())->showDetail($_GET['id']),
    'xoa-don-hang' => (new AdminDonHangController())->deleteDonHang($_GET['id']), //Xóa
    'cap-nhat-trang-thai-don-hang' => (new AdminDonHangController())->capNhatTrangThaiDonHang(),

};