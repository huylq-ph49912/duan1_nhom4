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
                                <!-- <li class="breadcrumb-item"><a href="shop.html">shop</a></li> -->
                                <li class="breadcrumb-item active" aria-current="page">Giỏ Hàng</li>
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
                <div class="col-lg-12">
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Ảnh Sản Phẩm</th>
                                    <th class="pro-title">Tên Sản Phẩm</th>
                                    <th class="pro-price">Giá Sản Phẩm</th>
                                    <th class="pro-quantity">Số Lượng</th>
                                    <th class="pro-subtotal">Tổng Tiền</th>
                                    <th class="pro-remove">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($chiTietGioHang)) : ?>
                                    <?php
                                    $tongGioHang = 0;
                                    foreach ($chiTietGioHang as $key => $sanPham) :
                                    ?>
                                        <tr>
                                            <td class="pro-thumbnail"><a href="#">
                                                <img class="img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="Product" /></a>
                                            </td>
                                            <td class="pro-title"><a href="#"><?= $sanPham['ten_san_pham'] ?></a></td>
                                            <td class="pro-price"><span>
                                                    <?= formatCurrencyVND($sanPham['gia_san_pham'] ?: 0) ?>
                                                </span>
                                            </td>
                                            <td class="pro-quantity">
                                                <div class="">
                                                    <span><?= $sanPham['so_luong'] ?></span>
                                                </div>
                                            </td>
                                            <td class="pro-subtotal"><span>
                                                    <?php
                                                    $tongTien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                    $tongGioHang += $tongTien;
                                                    echo formatCurrencyVND($tongTien);
                                                    ?>
                                                </span></td>
                                            <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Giỏ hàng của bạn đang trống!</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php if (!empty($chiTietGioHang)) : ?>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Đơn Hàng Của Bạn</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Tổng Số Tiền Sản Phẩm</td>
                                            <td><?= formatCurrencyVND($tongGioHang) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tiền Vận Chuyển</td>
                                            <td>30.000 VNĐ</td>
                                        </tr>
                                        <tr class="total">
                                            <td>Tổng Thanh Toán</td>
                                            <td class="total-amount"><?= formatCurrencyVND($tongGioHang + 30000) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn btn-sqr d-block">Đặt Hàng</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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
   document.querySelectorAll('.pro-remove a').forEach(removeButton => {
    removeButton.addEventListener('click', function (e) {
        e.preventDefault();
        const row = this.closest('tr');
        const productId = row.getAttribute('data-id'); // Lấy ID sản phẩm từ thuộc tính `data-id`

        // Gửi yêu cầu AJAX đến server
        fetch('<?= BASE_URL ?>?act=xoa-san-pham', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ product_id: productId }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Xóa dòng sản phẩm trên giao diện
                row.remove();
                // Cập nhật tổng giỏ hàng
                updateCartTotal();
            } else {
                alert('Không thể xóa sản phẩm, vui lòng thử lại!');
            }
        })
        .catch(error => {
            console.error('Lỗi khi xóa sản phẩm:', error);
            alert('Đã xảy ra lỗi, vui lòng thử lại sau!');
        });
    });
});
</script>