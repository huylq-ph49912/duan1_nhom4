<?php
class AdminSanPhamController{
    public $modelSanPham;
    public $modelDanhMuc;
    // khởi tạo
   public function __construct(){
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    // hiển thị danh sách
    public function danhSachSanPham(){
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once('./views/sanpham/listSanPham.php');
    }

    // hiển thị form thêm 
    public function fromAddSanPham(){
        $listDanhmuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once('./views/sanpham/addSanPham.php');
        deleteSessionError();

    }
}

?>