<!-- Header -->
<?php require './views/layout/header.php'; ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chi Tiết Sản Phẩm</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="col-12">
              <img style="width: 1000px;" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
              <?php foreach ($listAnhSanPham as $key => $anhSP): ?>
                <div class="product-image-thumb <?= $key == 0 ? 'active' : '' ?>">
                  <img src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image">
                </div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="col-span-1 sm:col-span-2 lg:col-span-1 p-6 bg-gray-50 rounded-lg shadow-md">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Sản Phẩm:
              <?= htmlspecialchars($sanPham['ten_san_pham']) ?></h3>
            <hr class="border-gray-300 my-4">

            <div class="space-y-3">
              <p class="text-lg text-gray-600">
                <strong class="text-gray-700">Giá Tiền:</strong>
                <span><?= htmlspecialchars($sanPham['gia_san_pham']) ?> USD</span>
              </p>
              <p class="text-lg text-gray-600">
                <strong class="text-gray-700">Giá Khuyến Mãi:</strong>
                <span><?= htmlspecialchars($sanPham['gia_khuyen_mai']) ?> USD</span>
              </p>
              <p class="text-lg text-gray-600">
                <strong class="text-gray-700">Số Lượng:</strong>
                <span><?= htmlspecialchars($sanPham['so_luong']) ?></span>
              </p>
              <p class="text-lg text-gray-600">
                <strong class="text-gray-700">Số Lượt Xem:</strong>
                <span><?= htmlspecialchars($sanPham['luot_xem']) ?></span>
              </p>
              <p class="text-lg text-gray-600">
                <strong class="text-gray-700">Ngày Nhập:</strong>
                <span><?= htmlspecialchars($sanPham['ngay_nhap']) ?></span>
              </p>
              <p class="text-lg text-gray-600">
                <strong class="text-gray-700">Danh Mục:</strong>
                <span><?= htmlspecialchars($sanPham['ten_danh_muc']) ?></span>
              </p>
              <p class="text-lg text-gray-600">
                <strong class="text-gray-700">Trạng Thái:</strong>
                <span class="<?= $sanPham['trang_thai'] == 1 ? 'text-green-500' : 'text-red-500' ?>">
                  <?= $sanPham['trang_thai'] == 1 ? 'Còn Hàng' : 'Hết Hàng' ?>
                </span>
              </p>
              <p class="text-lg text-gray-600">
                <strong class="text-gray-700">Mô Tả:</strong>
                <span><?= htmlspecialchars($sanPham['mo_ta']) ?></span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <?php
      // Lấy ID sản phẩm từ URL
      $id_san_pham = isset($_GET['id_san_pham']) ? (int) $_GET['id_san_pham'] : 0;


      echo "ID sản phẩm: " . $id_san_pham; // Debug ID sản phẩm
      echo "<br>";

      // Khởi tạo model để lấy bình luận
      $adminBinhLuan = new AdminBinhLuan();
      $binhLuanList = $adminBinhLuan->getBinhLuanBySanPhamId($id_san_pham);


      // Debug bình luận
      if ($binhLuanList === false) {
        echo "Có lỗi khi lấy bình luận.";
      } else {
        echo "Số bình luận: " . count($binhLuanList); // Hiển thị số lượng bình luận
      }

      ?>

      <?php
      // Lấy ID sản phẩm từ URL
      $id_san_pham = isset($_GET['id_san_pham']) ? (int) $_GET['id_san_pham'] : 0;

      // Khởi tạo model AdminBinhLuan
      $adminBinhLuan = new AdminBinhLuan();
      $binhLuanList = $adminBinhLuan->getBinhLuanBySanPhamId($id_san_pham);
      ?>

      <style>
        .comment-container {
          background-color: #f5f5f5;
          border-radius: 8px;
          padding: 20px;
          margin-bottom: 20px;
        }

        .comment-container .comment-header {
          display: flex;
          align-items: center;
          margin-bottom: 10px;
        }

        .comment-container .comment-header strong {
          font-size: 16px;
          font-weight: bold;
          margin-right: 10px;
        }

        .comment-container .comment-header span {
          font-size: 14px;
          color: #666;
        }

        .comment-container .comment-content {
          font-size: 15px;
          line-height: 1.5;
        }
      </style>
      <div class="comment-section">
        <h3>Bình luận</h3>
        <?php if ($binhLuanList !== false && !empty($binhLuanList)): ?>
          <?php foreach ($binhLuanList as $binhLuan): ?>
            <div class="comment-container">
              <div class="comment-header">
                <strong><?= isset($binhLuan['nguoi_dung_id']) ? htmlspecialchars($binhLuan['nguoi_dung_id']) : 'Ẩn danh' ?></strong>
                <span>Ngày: <?= htmlspecialchars($binhLuan['created_at']) ?></span>
              </div>
              <div class="comment-content">
                <?= htmlspecialchars($binhLuan['noi_dung']) ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>Không có bình luận nào cho sản phẩm này.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <!-- /.content -->
  <!-- /.content-wrapper -->

  <!-- Footer-->
  <?php include './views/layout/footer.php'; ?>
  <!-- End Footer -->

  <!-- Page specific script -->
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

    $(document).ready(function () {
      $('.product-image-thumb').on('click', function () {
        var $image_element = $(this).find('img');
        $('.product-image').prop('src', $image_element.attr('src'));
        $('.product-image-thumb.active').removeClass('active');
        $(this).addClass('active');
      });
    });
  </script>

  </body>

  </html>