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
    // Hiển Thị Form Thêm
    public function fromAddDanhMuc()
    {
        require_once('./views/danhmuc/addDanhMuc.php');
    }

    public function postAddDanhMuc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $image = $_FILES['hinh_anh']['name'];
            $error = [];

            if (empty($ten_danh_muc)) {
                $error['ten_danh_muc'] = 'Tên Danh Mục Không Được Bỏ Trống!';
            }
            if (empty($image)) {
                $error['image'] = 'Hình ảnh không được bỏ trống!';
            }

            if (empty($error)) {
                // Upload image
                $target_dir = "./uploads/";
                $target_file = $target_dir . basename($image);
                move_uploaded_file($_FILES['hinh_anh']['tmp_name'], $target_file);

                // Insert danh mục
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta, $image);
                header('Location:' . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                require_once('./views/danhmuc/addDanhMuc.php');
            }
        }
    }
    public function fromEditDanhMuc()
    {
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($danhMuc) {
            require_once('./views/danhmuc/editDanhMuc.php');
        } else {
            header('Location:' . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }

    public function postEditDanhMuc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $image = $_FILES['hinh_anh']['name'];
            $error = [];

            if (empty($ten_danh_muc)) {
                $error['ten_danh_muc'] = 'Tên Danh Mục Không Được Bỏ Trống!';
            }

            if (empty($error)) {
                if (!empty($image)) {
                    // Upload new image if provided
                    $target_dir = "./uploads/";
                    $target_file = $target_dir . basename($image);
                    move_uploaded_file($_FILES['hinh_anh']['tmp_name'], $target_file);

                    // Update danh mục with new image
                    $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta, $image);
                } else {
                    // Update danh mục without changing image
                    $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                }
                header('Location:' . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                $danhMuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                require_once('./views/danhmuc/editDanhMuc.php');
            }
        }
    }

    public function deleteDanhMuc()
    {
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($danhMuc) {
            // Delete image file
            $imagePath = './uploads/' . $danhMuc['hinh_anh'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $this->modelDanhMuc->destroyDanhMuc($id);
        }
        header('Location:' . BASE_URL_ADMIN . '?act=danh-muc');
        exit();
    }
}
?>