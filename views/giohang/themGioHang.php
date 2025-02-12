<?php
session_start();
require_once('config/database.php');

// Lấy dữ liệu từ form
$sanPhamId = $_POST['san_pham_id'] ?? null;
$soLuong = $_POST['so_luong'] ?? 1;

// Kiểm tra dữ liệu
if (!$sanPhamId || $soLuong <= 0) {
    header("Location: " . BASE_URL . "/gioHang.php?error=Invalid data");
    exit();
}

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$query = $db->prepare("SELECT id, ten_san_pham, gia_san_pham, hinh_anh FROM san_phams WHERE id = ?");
$query->execute([$sanPhamId]);
$sanPham = $query->fetch(PDO::FETCH_ASSOC);

if (!$sanPham) {
    header("Location: " . BASE_URL . "/gioHang.php?error=Product not found");
    exit();
}

// Kiểm tra giỏ hàng trong session
if (!isset($_SESSION['gio_hang'])) {
    $_SESSION['gio_hang'] = [];
}

// Kiểm tra sản phẩm có tồn tại trong giỏ hàng không
$exists = false;
foreach ($_SESSION['gio_hang'] as &$item) {
    if ($item['id'] == $sanPhamId) {
        $item['so_luong'] += $soLuong;
        $exists = true;
        break;
    }
}

// Nếu sản phẩm chưa tồn tại, thêm mới
if (!$exists) {
    $_SESSION['gio_hang'][] = [
        'id' => $sanPham['id'],
        'ten_san_pham' => $sanPham['ten_san_pham'],
        'gia_san_pham' => $sanPham['gia_san_pham'],
        'hinh_anh' => $sanPham['hinh_anh'],
        'so_luong' => $soLuong
    ];
}

// Chuyển hướng về giỏ hàng
header("Location: " . BASE_URL . "/gioHang.php");
exit();
