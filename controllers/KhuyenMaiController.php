<?php
class KhuyenMaiController
{
    public $modelKhuyenMai;

    public function __construct()
    {
        $this->modelKhuyenMai = new KhuyenMai();
    }

    // Hiển thị danh sách khuyến mãi
    public function danhSachKhuyenMai()
    {
        $listKhuyenMai = $this->modelKhuyenMai->getAllKhuyenMai();
        require_once('./views/khuyenmai/listKhuyenMai.php');
    }
}

?>
