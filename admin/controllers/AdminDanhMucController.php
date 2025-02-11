<?php
class AdminDanhMucController{
    public $modelDanhMuc;
    // khởi tạo
    public function __construct(){
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    // hiển thị danh sách
    public function danhSachDanhMuc(){
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once('./views/danhmuc/listDanhMuc.php');
    }
}
?>