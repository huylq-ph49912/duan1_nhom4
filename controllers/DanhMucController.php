<?php
    class AdminDanhMucController{
        public $modelDanhMuc;
        public function __construct(){
            $this -> modelDanhMuc = new AdminDanhMuc();
        }
        public function danhSachDanhMuc(){
            $listDanhMuc = $this ->modelDanhMuc->getAllDanhMuc();
            require_once('./views/danhmuc/listDanhMuc.php');
        }
        // Hiển Thị From Thêm
        public function fromAddDanhMuc(){
            require_once('./views/danhmuc/addDanhMuc.php');
        }
        public function postAddDanhMuc(){
            // Kiểm tra xem dữ liệu có phải được Thêm hay không 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Lấy ra dữ liệu
                $ten_danh_muc = $_POST['ten_danh_muc']; 
                $mo_ta = $_POST['mo_ta']; 
                // Tạo 1 mảng trống để chứa dữ liệu
                $error = [];
                if (empty($ten_danh_muc)) {
                    $error['ten_danh_muc'] = 'Tên Danh Mục Không Được Bỏ Trống !';
                }
                // Nếu Không Có Lỗi thì tiến hành thêm danh mục
                if(empty($error)){
                    $this-> modelDanhMuc-> insertDanhMuc($ten_danh_muc, $mo_ta);
                    header('Location:'. BASE_URL_ADMIN . '?act=danh-muc');
                    exit();
                }else{ //Nếu có lỗi trả về from và lỗi
                    require_once('./views/danhmuc/addDanhMuc.php');
                }
            }
        }
        //Sửa Danh Mục 
        public function fromEditDanhMuc(){
            //Lấy Ra thông tin của danh mục cần sửa
            $id = $_GET['id_danh_muc'];
            $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
            if ($danhMuc) {
                require_once('./views/danhmuc/editDanhMuc.php');
            }else{
                header('Location:'. BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            }
        }
        public function postEditDanhMuc(){
            // Kiểm tra xem dữ liệu có phải được Thêm hay không 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Lấy ra dữ liệu
                $id = $_POST['id']; 
                $ten_danh_muc = $_POST['ten_danh_muc']; 
                $mo_ta = $_POST['mo_ta']; 
                // Tạo 1 mảng trống để chứa dữ liệu
                $error = [];
                if (empty($ten_danh_muc)) {
                    $error['ten_danh_muc'] = 'Tên Danh Mục Không Được Bỏ Trống !';
                }
                // Nếu Không Có Lỗi thì tiến hành Sửa danh mục
                if(empty($error)){
                    $this-> modelDanhMuc->UpdateDanhMuc($id, $ten_danh_muc, $mo_ta);
                    header('Location:'. BASE_URL_ADMIN . '?act=danh-muc');
                    exit();
                }else{ //Nếu có lỗi trả về from và lỗi
                    $danhMuc = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                    require_once('./views/danhmuc/editDanhMuc.php');
                }
            }
        }
        // Xóa Danh Mục
        public function deleteDanhMuc(){
            $id = $_GET['id_danh_muc'];
            $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
            if ($danhMuc) {
                $this-> modelDanhMuc->destroyDanhMuc($id);
            }
            header('Location:'. BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }
?>