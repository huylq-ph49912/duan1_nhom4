<?php
ob_start();
require './views/layout/header.php';
include './views/layout/navbar.php';
include './views/layout/sidebar.php';

// Your form handling and header calls go here before any HTML is output
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['trang_thai_id'])) {
  $orderId = $_POST['id'];
  $trangThaiId = $_POST['trang_thai_id'];

  if (empty($orderId) || empty($trangThaiId)) {
    $_SESSION['error'] = "Thông tin không đầy đủ!";
    header("Location: " . BASE_URL_ADMIN . "/?act=chi-tiet-don-hang&id=" . $orderId);
    exit();
  }

  // Kiểm tra trạng thái hiện tại
  $order = $this->adminDonHang->getDonHangById($orderId); // Giả sử bạn có phương thức lấy đơn hàng theo ID
  $currentStatus = $order['trang_thai_id']; // Lấy trạng thái hiện tại từ cơ sở dữ liệu

  // Kiểm tra nếu đơn hàng đang ở trạng thái "Giao hàng thành công" (ID = 5), "Đã giao" (ID = 4), hoặc "Đã hủy" (ID = 7)
  if ($trangThaiId == 5 || in_array($currentStatus, [5, 6, 7])) {
    $_SESSION['error'] = "Không thể cập nhật trạng thái này!";
    header("Location: " . BASE_URL_ADMIN . "/?act=chi-tiet-don-hang&id=" . $orderId);
    exit();
  }

  // Cập nhật trạng thái đơn hàng
  $updateResult = $this->adminDonHang->updateTrangThaiDonHang($orderId, $trangThaiId);

  if ($updateResult) {
    $_SESSION['success'] = "Cập nhật trạng thái đơn hàng thành công!";
    header("Location: " . BASE_URL_ADMIN . "/?act=don-hang");
    exit();
  } else {
    $_SESSION['error'] = "Cập nhật trạng thái đơn hàng thất bại!";
    header("Location: " . BASE_URL_ADMIN . "/?act=chi-tiet-don-hang&id=" . $orderId);
    exit();
  }
}

?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Chi Tiết Đơn Hàng</h1>
          <a href="<?= BASE_URL_ADMIN . '/?act=don-hang' ?>">
            <button class="btn btn-success">Quay lại</button>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <?php if (isset($_SESSION['success'])): ?>
      <div class="success"><?= $_SESSION['success'] ?></div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="error"><?= $_SESSION['error'] ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <div class="container-fluid">
      <div class="row">
        <div class="card col-12" style="display: flex; flex-direction: row;">
          <div class="col-4">
            <div class="card-header">
              <h3 class="card-title">Thông Tin Đơn Hàng</h3>
            </div>
            <div class="card-body">
              <p><strong>Tên Người Nhận:</strong> <?= htmlspecialchars($order['ten_nguoi_nhan']); ?></p>
              <p><strong>Mã Đơn Hàng:</strong> <?= htmlspecialchars($order['ma_don_hang']); ?></p>
              <p><strong>Ngày Đặt:</strong> <?= htmlspecialchars($order['ngay_dat']); ?></p>
              <p><strong>Tổng Tiền:</strong> <?= number_format($order['tong_tien'], 0, ',', '.'); ?> VND</p>
              <p><strong>Trạng Thái:</strong>
                <?php
                $class = '';
                switch ($order['trang_thai_id']) {
                  case 1:
                    $class = 'status-pending';
                    break;
                  case 2:
                    $class = 'status-confirmed';
                    break;
                  case 3:
                    $class = 'status-in-transit';
                    break;
                  case 4:
                    $class = 'status-delivered';
                    break;
                  case 5:
                    $class = 'status-successful';
                    break;
                  case 6:
                    $class = 'status-failed';
                    break;
                  case 7:
                    $class = 'status-canceled';
                    break;
                }
                echo '<span class="' . $class . '">' . $order['trang_thai'] . '</span>';
                ?>
              </p>
              <?php if (!in_array($order['trang_thai_id'], [5, 6, 7])): ?>
                <form action="<?= BASE_URL_ADMIN . '/?act=chi-tiet-don-hang&id=' . $order['id'] ?>" method="post">
                  <input type="hidden" name="id" value="<?= $order['id'] ?>">
                  <select name="trang_thai_id" class="form-control">
                    <?php
                    $nextTrangThai = null;
                    foreach ($listTrangThai as $trangThai) {

                      if ($trangThai['id'] > $order['trang_thai_id'] && $trangThai['id'] != 5) {
                        $nextTrangThai = $trangThai;
                        break;
                      }
                    }
                    if ($nextTrangThai): ?>
                      <option value="<?= $nextTrangThai['id'] ?>" selected>
                        <?= $nextTrangThai['ten_trang_thai'] ?>
                      </option>
                    <?php endif; ?>
                  </select>

                  <button type="submit" class="btn btn-success">Cập nhật</button>
                </form>
              <?php else: ?>
                <p class="text-danger">Không thể cập nhật!!!</p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="card col-12">
          <div class="card-header">
            <h3 class="card-title">Thông Tin Sản Phẩm</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Tên sản phẩm</th>
                  <th>Giá sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Hình ảnh sản phẩm</th>
                  <th>Thành tiền</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($order['products'])): ?>
                  <?php foreach ($order['products'] as $product): ?>
                    <tr>
                      <td><?= htmlspecialchars($product['ten_san_pham']) ?></td>
                      <td><?= number_format($product['gia_san_pham'], 0, ',', '.') ?> VND</td>
                      <td><?= htmlspecialchars($product['so_luong']) ?></td>
                      <td>
                        <img src="<?= BASE_URL . htmlspecialchars($product['hinh_anh']) ?>" style="width: 100px"
                          alt="Product Image" onerror="this.onerror=null;">
                      </td>
                      <td>
                        <?= number_format($product['gia_san_pham'] * $product['so_luong'], 0, ',', '.') ?> VND
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5">Không có sản phẩm nào.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<?php require './views/layout/footer.php'; ?>