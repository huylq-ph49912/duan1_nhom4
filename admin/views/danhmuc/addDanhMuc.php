<!-- Header -->
<?php require './views/layout/header.php';?>
<!-- Navbar -->
<?php include './views/layout/navbar.php';?>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php';?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản Lý Danh Mục Sản Phẩm</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thêm Danh Mục Sản Phẩm</h3>
                        </div>
                        <form action="<?= BASE_URL_ADMIN . '/?act=them-danh-muc' ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tên Danh Mục</label>
                                    <input type="text" class="form-control" name="ten_danh_muc" placeholder="Nhập tên danh mục">
                                    <?php if (isset($error['ten_danh_muc'])) { ?>
                                        <p class="text-danger"><?= $error['ten_danh_muc'] ?></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Mô Tả Danh Mục</label>
                                    <textarea name="mo_ta" class="form-control" placeholder="Nhập mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Hình Ảnh</label>
                                    <input type="file" class="form-control" name="hinh_anh">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Footer -->
<?php include './views/layout/footer.php'; ?>
<!-- End Footer -->
</body>
</html>
