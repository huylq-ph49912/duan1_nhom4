<!-- Header -->
<?php require './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- Sidebar -->
<?php include './views/layout/sidebar.php'; ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Quản Lý Danh Sách Sản Phẩm</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
     <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-header">Thêm Sản Phẩm</h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN. '/?act=them-san-pham'?>" method="POST" enctype="multipart/form-data">
                            <div  class="card-body row" >
                                <div class="form-group col-12">
                                    <label>Tên Sản Phẩm</label>
                                    <input type="text" class="form-control" name="ten_san_pham" placeholder="Nhập tên sản phẩm">
                                    <?php if(isset($_SESSION['error']['ten_san_pham'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['ten_san_pham']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Giá Sản Phẩm</label>
                                    <input type="number" class="form-control" name="gia_san_pham" placeholder="Nhập giá sản phẩm">
                                    <?php if(isset($_SESSION['error']['gia_san_pham'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['gia_san_pham']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Giá Khuyến Mãi Sản Phẩm</label>
                                    <input type="number" class="form-control" name="gia_khuyen_mai" placeholder="Nhập giá khuyến mãi sản phẩm">
                                    <?php if(isset($_SESSION['error']['gia_khuyen_mai'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['gia_khuyen_mai']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Hình Ảnh Sản Phẩm</label>
                                    <input type="file" class="form-control" name="hinh_anh" >
                                    <?php if(isset($_SESSION['error']['hinh_anh'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['hinh_anh']?></p>
                                    <?php } ?>
                                </div><div class="form-group col-6">
                                    <label>Album Ảnh</label>
                                    <input type="file" class="form-control" name="img_array[]" multiple>
                                    
                                </div><div class="form-group col-6">
                                    <label>Số Lượng Sản Phẩm</label>
                                    <input type="number" class="form-control" name="so_luong" placeholder="Nhập số lượng sản phẩm">
                                    <?php if(isset($_SESSION['error']['so_luong'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['so_luong']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Ngày Nhập Sản Phẩm</label>
                                    <input type="date" class="form-control" name="ngay_nhap" placeholder="Nhập giá sản phẩm">
                                    <?php if(isset($_SESSION['error']['ngay_nhap'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['ngay_nhap']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Danh Mục Sản Phẩm</label>
                                    <select class="from-control" name="danh_muc_id" id="exampleFormControlSelect1">
                                        <option selected disabled> Chọn danh mục sản phẩm</option>
                                    <?php foreach($listDanhMuc as $danhMuc):?>
                                        <option value="<?= $danhMuc['id']?>"><?= $danhMuc['ten_danh_muc'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php if(isset($_SESSION['error']['danh_muc_id'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['danh_muc_id']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-6">
                                    <label>Trang Thái Sản Phẩm</label>
                                    <select class="from-control" name="trang_thai" id="exampleFormControlSelect1">
                                        <option selected disabled> Chọn trạng thái sản phẩm</option>
                                        <option value="1">Còn Hàng</option>
                                        <option value="2">Hết Hàng</option>
                                    </select>
                                    <?php if(isset($_SESSION['error']['trang_thai'])){ ?>
                                        <p class="text-danger"><?= $_SESSION['error']['trang_thai']?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-12">
                                    <label> Mô tả danh mục</label>
                                    <textarea name="mo_ta" id="" class="form-control" placeholder="Nhập mô tả"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     </section>
</div>

<!-- Footer -->
<?php require './views/layout/footer.php'; ?>
