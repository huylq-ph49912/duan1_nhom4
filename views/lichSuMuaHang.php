<?php require_once('views/layout/header.php'); ?>
<?php require_once('views/layout/menu.php'); ?>
<?php if (isset($_SESSION['success_message'])): ?>
    <div
        style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin: 10px 0;">
        <?= $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
<main>

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=/' ?>">Shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đơn Hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã đon hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trang thái đơn hàng</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($donHangs as $donHang):
                                        ?>
                                        <tr>
                                            <td class="text-center"><strong><?= $donHang['ma_don_hang'] ?></strong></td>
                                            <td><?= $donHang['ngay_dat'] ?></td>
                                            <td><?= formatCurrencyVND($donHang['tong_tien']) . ' đ' ?></td>
                                            <td><?= $phuongThucThanhToan[$donHang['payment_method_id']] ?></td>
                                            <!-- <td><?= $trangThaiDonHang[$donHang['trang_thai_id']] ?></td> -->
                                            <td class="status-text">
                                                <?php
                                                switch ($donHang['trang_thai_id']) {
                                                    case 1:
                                                        echo '<span class="status-pending">' . $trangThaiDonHang[$donHang['trang_thai_id']] . '</span>';
                                                        break;
                                                    case 2:
                                                        echo '<span class="status-confirmed">' . $trangThaiDonHang[$donHang['trang_thai_id']] . '</span>';
                                                        break;
                                                    case 3:
                                                        echo '<span class="status-in-transit">' . $trangThaiDonHang[$donHang['trang_thai_id']] . '</span>';
                                                        break;
                                                    case 4:
                                                        echo '<span class="status-delivered">' . $trangThaiDonHang[$donHang['trang_thai_id']] . '</span>';
                                                        break;
                                                    case 5:
                                                        echo '<span class="status-successful-delivery">' . $trangThaiDonHang[$donHang['trang_thai_id']] . '</span>';
                                                        break;
                                                    case 6:
                                                        echo '<span class="status-failed-delivery">' . $trangThaiDonHang[$donHang['trang_thai_id']] . '</span>';
                                                        break;
                                                    case 7:
                                                        echo '<span class="status-canceled">' . $trangThaiDonHang[$donHang['trang_thai_id']] . '</span>';
                                                        break;
                                                    default:
                                                        echo $trangThaiDonHang[$donHang['trang_thai_id']];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?= BASE_URL ?>?act=chi-tiet-mua-hang&id=<?= $donHang['id'] ?>"
                                                    class="btn btn-sqr">Chi tiết</a>
                                                <?php if ($donHang['trang_thai_id'] == 1): ?>
                                                    <a href="<?= BASE_URL ?>?act=huy-don-hang&id=<?= $donHang['id'] ?>&return_url=<?= urlencode($_SERVER['REQUEST_URI']) ?>"
                                                        class="btn btn-sqr"
                                                        onclick="return confirm('Xác nhận huỷ đơn hàng!!!')">
                                                        Huỷ đơn hàng
                                                    </a>
                                                <?php endif; ?>

                                                <?php if ($donHang['trang_thai_id'] == 4): ?>
                                                    <a href="<?= BASE_URL ?>?act=xac-nhan-nhan-hang&id=<?= $donHang['id'] ?>&return_url=<?= urlencode($_SERVER['REQUEST_URI']) ?>"
                                                        class="btn btn-sqr"
                                                        onclick="return confirm('Xác nhận bạn đã nhận hàng?')">
                                                        Đã nhận hàng
                                                    </a>
                                                <?php endif; ?>
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
    </div>

</main>

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


            document.querySelector('.cart-calculator-wrapper .total-amount').textContent = (total + 30).toLocaleString() + ' USD'; // Bao gồm phí vận chuyển
            document.querySelector('.cart-calculator-wrapper td:first-child + td').textContent = total.toLocaleString() + ' USD'; // Tổng sản phẩm
        }
    });
</script>

<style>
    .status-pending {
        color: #f39c12;
        font-weight: bold;
    }

    .status-confirmed {
        color: #3498db;
        font-weight: bold;
    }

    .status-in-transit {
        color: #f1c40f;
        font-weight: bold;
    }

    .status-delivered {
        color: #2ecc71;
        font-weight: bold;
    }

    .status-successful-delivery {
        color: #27ae60;
        font-weight: bold;
    }

    .status-failed-delivery {
        color: #e74c3c;
        font-weight: bold;
    }

    .status-canceled {
        color: #e67e22;
        font-weight: bold;
    }
</style>