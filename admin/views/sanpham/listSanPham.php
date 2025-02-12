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
                    <h1>Quản Lý Danh Sách Thời Trang</h1>
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
                            <a href="<?= BASE_URL_ADMIN. '?act=from-them-san-pham' ?>"><button class="btn btn-success">Thêm Sản Phẩm Mới</button></a>
                        </div>
                        <!-- card-header -->
                         <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Ảnh Sản Phẩm</th>
                                        <th>Giá Tiền</th>
                                        <th>Số Lượng</th>
                                        <th>Danh Mục</th>
                                        <th>Trạng Thái</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($listSanPham as $key => $sanPham): ?>
                                        <tr>
                                            <td><?= $key+1 ?></td>
                                            <td><?= $sanPham['ten_san_pham'] ?></td>
                                            <td><img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" style="width: 100px" alt="" onerror="this.onerror=null; this.src=''"></td>
                                            <td><?= $sanPham['gia_san_pham'] ?></td>
                                            <td><?= $sanPham['so_luong'] ?></td>
                                            <td><?= $sanPham['ten_danh_muc'] ?></td>
                                            <td><?= $sanPham['trang_thai'] == 1 ? 'Còn Hàng' : 'Hết Hàng' ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?= BASE_URL_ADMIN. '/?act=chi-tiet-san-pham&id_san_pham=' .$sanPham['id']?>">
                                                        <button class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                                    </a>
                                                    <a href="<?= BASE_URL_ADMIN. '/?act=from-edit-san-pham&id_san_pham=' .$sanPham['id']?>">
                                                        <button class="btn btn-warning"><i class="fas fa-wrench"></i></button>
                                                    </a>
                                                    <a href="<?= BASE_URL_ADMIN. '/?act=delete-san-pham&id_san_pham=' .$sanPham['id']?>" 
                                                    onclick="return confirm('bạn có muốn xoá sản phẩm này không?')">
                                                        <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                    </a>
                                                </div>
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
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            
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
