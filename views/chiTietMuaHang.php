<?php require_once('views/layout/header.php'); ?>
<?php require_once('views/layout/menu.php'); ?>
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">Shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn Hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-7">

                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Đơn giá</th> <!-- Thêm cột "Đơn giá" -->
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($chiTietDonHangs as $item): ?>
                                        <tr>
                                            <td><img class="img-fluid" src="<?= BASE_URL . $item['hinh_anh'] ?>"
                                                    alt="Product" /></td>
                                            <td><?= $item['ten_san_pham'] ?></td>
                                            <td><?= number_format($item['don_gia'], 0, ',', '.') ?> VNĐ</td>
                                            <!-- Hiển thị đơn giá -->
                                            <td><?= $item['so_luong'] ?></td>
                                            <td>
                                                <?php
                                                $thanhTien = $item['don_gia'] * $item['so_luong']; // Tính thành tiền
                                                echo number_format($thanhTien, 0, ',', '.') . ' VNĐ'; // Hiển thị thành tiền
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                                </tbody>

                            </table>
                        </div>


                    </div>



                    <div class="col-lg-5">

                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Thông tin đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">

                                        <th>Mã đơn hàng</th>
                                        <td><?= $donHangs['ma_don_hang'] ?></td>

                                    </tr>
                                    <tr class="text-center">

                                        <th>Người nhận</th>
                                        <td><?= $donHangs['ten_nguoi_nhan'] ?></td>

                                    </tr>
                                    <tr class="text-center">

                                        <th>Email người nhận</th>
                                        <td><?= $donHangs['email_nguoi_nhan'] ?></td>

                                    </tr>
                                    <tr class="text-center">

                                        <th>Số điện thoại</th>
                                        <td><?= $donHangs['sdt_nguoi_nhan'] ?></td>

                                    </tr>
                                    <tr class="text-center">

                                        <th>Địa chị nhận</th>
                                        <td><?= $donHangs['dia_chi_nguoi_nhan'] ?></td>

                                    </tr>
                                    <tr class="text-center">

                                        <th>Ngày đặt</th>
                                        <td><?= $donHangs['ngay_dat'] ?></td>

                                    </tr>
                                    <tr class="text-center">

                                        <th>Ghi chú</th>
                                        <td><?= $donHangs['ghi_chu'] ?></td>

                                    </tr>
                                    <tr class="text-center">

                                        <th>Tổng tiền</th>
                                        <td><?= formatCurrencyVND($donHangs['tong_tien']) ?></td>

                                    </tr>
                                    <tr class="text-center">

                                        <th>Phương thức thanh toán</th>

                                        <td><?= $phuongThucThanhToan[$donHangs['payment_method_id']] ?></td>
                                    </tr>

                                    <tr class="text-center">

                                        <th>Trạng thái đon hàng</th>

                                        <td><?= $trangThaiDonHang[$donHangs['trang_thai_id']] ?></td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
</main>
<!-- offcanvas mini cart start -->
<!-- offcanvas mini cart end -->
<?php require_once('views/layout/footer.php'); ?>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const so_luong = document.getElementById("so_luong").value
        console.log(so_luong);

        // Cập nhật tổng tiền khi thay đổi số lượng
        document.querySelectorAll('.pro-qty input').forEach(input => {
            input.addEventListener('input', function () {
                const row = this.closest('tr');
                const priceElement = row.querySelector('.pro-price span');
                const subtotalElement = row.querySelector('.pro-subtotal span');
                const unitPrice = parseFloat(priceElement.textContent.replace(' USD', '').replace(',', ''));
                const quantity = parseInt(this.value) || 0;

                // Cập nhật tổng tiền của sản phẩm
                const newSubtotal = unitPrice * quantity;
                subtotalElement.textContent = newSubtotal.toLocaleString() + ' USD';

                // Cập nhật tổng giỏ hàng
                updateCartTotal();
            });
        });

        // Xóa sản phẩm khi nhấn vào nút xóa
        document.querySelectorAll('.pro-remove a').forEach(removeButton => {
            removeButton.addEventListener('click', function (e) {
                e.preventDefault();
                const row = this.closest('tr');
                row.remove();

                // Cập nhật tổng giỏ hàng
                updateCartTotal();
            });
        });

        // Hàm cập nhật tổng giỏ hàng
        function updateCartTotal() {
            let total = 0;
            document.querySelectorAll('.pro-subtotal span').forEach(subtotalElement => {
                const subtotal = parseFloat(subtotalElement.textContent.replace(' USD', '').replace(',', ''));
                total += subtotal;
            });

            // Hiển thị tổng số tiền trong bảng tổng
            document.querySelector('.cart-calculator-wrapper .total-amount').textContent = (total + 30).toLocaleString() + ' USD'; // Bao gồm phí vận chuyển
            document.querySelector('.cart-calculator-wrapper td:first-child + td').textContent = total.toLocaleString() + ' USD'; // Tổng sản phẩm
        }
    });
</script>