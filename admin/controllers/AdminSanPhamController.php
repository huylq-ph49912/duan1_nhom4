<?php
    class AdminSanPhamController{
        public $modelSanPham;
        public $modelDanhMuc;
        // Khởi tạo
        public function __construct(){
            $this -> modelSanPham = new AdminSanPham();
            $this -> modelDanhMuc = new AdminDanhMuc();
        }
        // Hiển Thị Danh Sách 
        public function danhSachSanPham(){
            $listSanPham = $this ->modelSanPham->getAllSanPham();
            require_once('./views/sanpham/listSanPham.php');
        }
        // Hiển Thị From Thêm
        public function fromAddSanPham(){
            $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
            require_once('./views/sanpham/addSanPham.php');
            deleteSessionError();   
        }
        public function postAddSanPham(){
            // Kiểm tra xem dữ liệu có phải được Thêm hay không 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Lấy ra dữ liệu
                $ten_san_pham = $_POST['ten_san_pham'] ?? ''; 
                $gia_san_pham = $_POST['gia_san_pham'] ?? ''; 
                $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? ''; 
                $so_luong = $_POST['so_luong'] ?? ''; 
                $ngay_nhap = $_POST['ngay_nhap'] ?? ''; 
                $danh_muc_id = $_POST['danh_muc_id'] ?? ''; 
                $trang_thai = $_POST['trang_thai'] ?? ''; 
                $mo_ta = $_POST['mo_ta'] ?? '';
                $hinh_anh = $_FILES['hinh_anh'] ?? null;
                // Lưu Hình Ảnh
                $file_thumb = uploadFile($hinh_anh, './uploads/');
                $img_array = $_FILES['img_array'];
                // Tạo 1 mảng trống để chứa dữ liệu
                $error = [];
                if (empty($ten_san_pham)) {
                    $error['ten_san_pham'] = 'Tên Sản Phẩm Không Được Bỏ Trống !';
                }
                if (empty($gia_san_pham)) {
                    $error['gia_san_pham'] = 'Giá Sản Phẩm Không Được Bỏ Trống !';
                }
                if (empty($gia_khuyen_mai)) {
                    $error['gia_khuyen_mai'] = 'Giá Khuyến Mại Không Được Bỏ Trống !';
                }
                if (empty($so_luong)) {
                    $error['so_luong'] = 'Số Lượng Sản Phẩm Không Được Bỏ Trống !';
                }
                if (empty($ngay_nhap)) {
                    $error['ngay_nhap'] = 'Ngày Nhập Không Được Bỏ Trống !';
                }
                if (empty($danh_muc_id)) {
                    $error['danh_muc_id'] = 'Danh Mục Sản Phẩm Không Được Bỏ Trống !';
                }
                if (empty($trang_thai)) {
                    $error['trang_thai'] = 'Trạng Thái Sản Phẩm Không Được Bỏ Trống !';
                }
                if ($hinh_anh['error'] !== 0) {
                    $error['hinh_anh'] = 'Vui Lòng Chọn Ảnh Sản Phẩm !';
                }
                $_SESSION['error'] = $error;
                // Nếu Không Có Lỗi thì tiến hành thêm Sản Phẩm
                if(empty($error)){
                    $san_pham_id = $this-> modelSanPham-> insertSanPham($ten_san_pham, 
                                                        $gia_san_pham, 
                                                        $gia_khuyen_mai,
                                                        $so_luong,
                                                        $ngay_nhap,
                                                        $danh_muc_id,
                                                        $trang_thai,
                                                        $mo_ta,
                                                        $file_thumb
                                                    );
                    // Xử Lý Thêm Album
                    if (!empty($img_array['name'])) {
                        foreach ($img_array['name'] as $key=>$value){
                            $file = [
                                'name' => $img_array['name'][$key],
                                'type' => $img_array['type'][$key],
                                'tmp_name' => $img_array['tmp_name'][$key],
                                'error' => $img_array['error'][$key],
                                'size' => $img_array['size'][$key],
                            ];
                            $link_hinh_anh = uploadFile($file, './uploads/');
                            $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                        }
                    }
                    header('Location:'. BASE_URL_ADMIN . '?act=san-pham');
                    exit();
                }else{ //Nếu có lỗi trả về from và lỗi
                    $_SESSION['flash'] = true;
                    header('Location:' . BASE_URL_ADMIN . '?act=from-them-san-pham');
                    exit();
                }
            }
        }
        // //Sửa Sản Phẩm 
        public function fromEditSanPham(){
            //Lấy Ra thông tin của sản phẩm cần sửa
            $id = $_GET['id_san_pham'];
            $sanPham = $this->modelSanPham->getDetailSanPham($id);
            $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
            $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
            if ($sanPham) {
                require_once('./views/sanpham/editSanPham.php');
                deleteSessionError();
            }else{
                header('Location:'. BASE_URL_ADMIN . '?act=san-pham');
                exit();
            }
        }
        public function postEditSanPham() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $san_pham_id = $_POST['san_pham_id'] ?? '';
                $sanPhamOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
                $old_file = $sanPhamOld['hinh_anh'];
        
                $ten_san_pham = $_POST['ten_san_pham'] ?? ''; 
                $gia_san_pham = $_POST['gia_san_pham'] ?? ''; 
                $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? ''; 
                $so_luong = $_POST['so_luong'] ?? ''; 
                $ngay_nhap = $_POST['ngay_nhap'] ?? ''; 
                $danh_muc_id = $_POST['danh_muc_id'] ?? ''; 
                $trang_thai = $_POST['trang_thai'] ?? ''; 
                $mo_ta = $_POST['mo_ta'] ?? '';
                $hinh_anh = $_FILES['hinh_anh'] ?? null;
                
                $error = [];
                if (empty($ten_san_pham)) {
                    $error['ten_san_pham'] = 'Tên Sản Phẩm Không Được Bỏ Trống!';
                }
                // Kiểm tra lỗi cho các trường khác nếu cần...
                
                $_SESSION['error'] = $error;
        
                // Xử lý ảnh
                if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                    $new_file = uploadFile($hinh_anh, './uploads/');
                    if (!empty($old_file)) {
                        deleteFile($old_file);
                    }
                } else {
                    $new_file = $old_file;   
                }
        
                if (empty($error)) {
                    $this->modelSanPham->updateSanPham(
                        $san_pham_id,
                        $ten_san_pham, 
                        $gia_san_pham, 
                        $gia_khuyen_mai,
                        $so_luong,
                        $ngay_nhap,
                        $danh_muc_id,
                        $trang_thai,
                        $mo_ta,
                        $new_file
                    );
                    header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
                    exit();
                } else {
                    $_SESSION['flash'] = true;
                    header('Location: ' . BASE_URL_ADMIN . '?act=from-edit-san-pham&id_san_pham=' . $san_pham_id);
                    exit();
                }
            }
        } 
        // Sửa Album ảnh
        public function postEditAnhSanPham(){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $san_pham_id = $_POST['san_pham_id'] ?? '';
                // Lấy danh sách ảnh hiện tại của sản phẩm
                $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);
                // Xử lý các ảnh được gửi từ Form 
                $img_array = $_FILES['img_array'];
                $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']): [];
                $current_img_ids = $_POST['current_img_ids'] ?? [];
                // Khai báo mảng lưu ảnh thêm mới hoặc thay thế
                $upload_file = [];
                // Upload ảnh mới hoặc thay đổi
                foreach($img_array['name'] as $key => $value) {
                    if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
                        $new_file = uploadFileAlbum($img_array, './uploads/', $key);    
                        if ($new_file) {
                            $upload_file[] = [
                                'id' => $current_img_ids[$key] ?? null,
                                'file' => $new_file 
                            ];
                        }
                    }
                }
                // Lưu ảnh mới vào Db và xóa ảnh cũ nếu có
                foreach($upload_file as $file_info){
                    if ($file_info['id']) {
                        $old_file = $this->modelSanPham->getDetaiAnhSanPham($file_info['id'])['link_hinh_anh'];
                        // Cập nhật ảnh cũ 
                        $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);
                        // Xóa ảnh cũ 
                        deleteFile($old_file);
                    }else{
                        // Thêm Ảnh Mới 
                        $this ->modelSanPham-> insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
                    }
                }
                // Xử lý xóa ảnh 
                foreach ($listAnhSanPhamCurrent as $anhSP){
                    $anh_id = $anhSP['id'];
                    if (in_array($anh_id, $img_delete)) {
                        // Xóa ảnh
                        $this->modelSanPham->destroyAnhSanPham($anh_id);
                        // Xóa file 
                        deleteFile($anhSP['link_hinh_anh']);

                    }
                }
                header('Location: ' . BASE_URL_ADMIN . '?act=from-edit-san-pham&id_san_pham=' . $san_pham_id);
                    exit();
            }
        }
        // Xóa Sản Phẩm
        public function deleteSanPham(){
            $id = $_GET['id_san_pham'];
            $sanPham = $this->modelSanPham->getDetailSanPham($id);
            $listAnhSanPham = $this -> modelSanPham->getListAnhSanPham($id);
            if ($sanPham) {
                deleteFile($sanPham['hinh_anh']);
                $this->modelSanPham->destroySanPham($id);
            }
            if ($listAnhSanPham) {
                foreach($listAnhSanPham as $key => $anhSP){
                    deleteFile($anhSP['link_hinh_anh']);
                    $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
                }
            }
            header('Location:'. BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
        // Chi tiết sản phẩm
        public function detailSanPham(){
            //Lấy Ra thông tin của sản phẩm cần sửa
            $id = $_GET['id_san_pham'];
            $sanPham = $this->modelSanPham->getDetailSanPham($id);
            $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
            $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
            if ($sanPham) {
                require_once('./views/sanpham/detailSanPham.php');
            }else{
                header('Location:'. BASE_URL_ADMIN . '?act=san-pham');
                exit();
            }
        }
    }
?>