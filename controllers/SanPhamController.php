<?php
require_once './models/SanPham.php';
require_once './models/DanhMuc.php'; // Đảm bảo tệp này tồn tại và đường dẫn chính xác

class SanPhamController
{
    private $modelSanPham;
    private $modelDanhMuc;

    public function __construct() {
        $this->modelSanPham = new SanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    // Hiển thị tất cả sản phẩm
    public function tatCaSanPham() {
        $sanPhamList = $this->modelSanPham->getAllSanPham();
        require_once './views/all.php';
    }

    // Hiển thị sản phẩm theo danh mục
    public function sanPhamTheoDanhMuc($danhMucId) {
        $danhMuc = $this->modelDanhMuc->getDanhMucById($danhMucId);
        if ($danhMuc) {
            $listSanPham = $this->modelSanPham->getSanPhamByDanhMuc($danhMucId);
            require_once('./views/sanPhamTheoDanhMuc.php');
        } else {
            header('Location:' . BASE_URL);
            exit();
        }
    }
}
?>