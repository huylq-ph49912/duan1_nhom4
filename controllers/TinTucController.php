<?php
class TinTucController
{
    public $modelTinTuc;

    public function __construct()
    {
        $this->modelTinTuc = new TinTuc(); // Khởi tạo model TinTuc
    }

    public function danhSachTinTuc()
    {
        $listTinTuc = $this->modelTinTuc->getAllTinTuc(); // Gọi hàm lấy danh sách tin tức
        require_once('./views/tintuc/listTinTuc.php'); // Load view danh sách tin tức
    }

    public function chiTietTinTuc($id)
    {
        // Kiểm tra ID hợp lệ trước khi gọi hàm
        if (!is_numeric($id) || $id <= 0) {
            echo "ID không hợp lệ.";
            return;
        }

        // Gọi hàm getTinTucById trong model để lấy tin tức chi tiết
        $tinTucDetail = $this->modelTinTuc->getTinTucById($id);

        if ($tinTucDetail) {
            require_once('./views/tintuc/chiTietTinTuc.php'); // Load view chi tiết tin tức
        } else {
            echo "Không tìm thấy tin tức.";
        }
    }
}


?>