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
                    <h1>Quản Lý Danh Mục Sản Phẩm</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="cantainer-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= BASE_URL_ADMIN . '?act=from-them-danh-muc' ?>"><button class="btn btn-success">Thêm Danh Mục Mới</button></a>
                        </div>
                        <!-- card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Hình Ảnh</th>
                                        <th>Tên Danh Mục</th>
                                        <th>Mô Tả</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listDanhMuc as $key => $danhMuc): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><img src="<?= BASE_URL_ADMIN . '/uploads/' . $danhMuc['hinh_anh'] ?>" style="width: 100px; height: auto" alt="Hình ảnh danh mục">
                                            </td>
                                            <td><?= $danhMuc['ten_danh_muc'] ?></td>
                                            <td><?= $danhMuc['mo_ta'] ?></td>

                                            <td>

                                                <a href="<?= BASE_URL_ADMIN. '?act=from-edit-danh-muc&id_danh_muc=' . $danhMuc['id'] ?>">
                                                    <button class="btn btn-warning">Sửa</button>
                                                </a>
                                                <a href="<?= BASE_URL_ADMIN. '?act=delete-danh-muc&id_danh_muc=' . $danhMuc['id'] ?>"
                                                    onclick="return confirm('bạn có muốn xoá sản phẩm này không?')">
                                                    <button class="btn btn-danger">Xoá</button>
                                                </a>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- Footer -->
<?php require './views/layout/footer.php'; ?>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>