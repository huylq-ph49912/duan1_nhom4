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
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class=" fa fa-home"></i></a>
                                </li>
                                <!-- <li class="breadcrumb-item"><a href="shop.html">shop</a></li> -->
                                <li class="breadcrumb-item active" aria-current="page">Thanh Toán</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="checkoutaccordion" id="checkOutAccordion">
                        <!-- Mã Giảm Giá -->
                        <div class="card">
                            <h6>Bạn Có Voucher?<span data-bs-toggle="collapse" data-bs-target="#couponaccordion">Chọn
                                    vào đây để nhập code</span></h6>
                            <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                <div class="card-body">
                                    <div class="cart-update-option">
                                        <div class="apply-coupon-wrapper">
                                            <form action="#" method="post" class=" d-block d-md-flex">
                                                <input type="text" placeholder="Xin mời nhập mã voucher" required />
                                                <button class="btn btn-sqr">Xác nhận</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="<?= BASE_URL . '?act=xu-ly-thanh-toan' ?>" method="post">
                <div class="row">
                    <!-- Người Mua Hàng -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Thông Tin Người Nhận</h5>
                            <div class="billing-form-wrap">
                                <!-- Tên người nhận -->
                                <div class="single-input-item">
                                    <label for="ten_nguoi_nhan" class="required">Tên Người Nhận</label>
                                    <input type="text" id="ten_nguoi_nhan" name="ten_nguoi_nhan"
                                        value="<?= isset($user['ho_ten']) ? $user['ho_ten'] : '' ?>"
                                        placeholder="Tên Người Nhận" required />
                                </div>

                                <!-- Email người nhận -->
                                <div class="single-input-item">
                                    <label for="email_nguoi_nhan" class="required">Email Người Nhận</label>
                                    <input type="email" id="email_nguoi_nhan" name="email_nguoi_nhan"
                                        value="<?= isset($user['email']) ? $user['email'] : '' ?>"
                                        placeholder="Email Người Nhận" required />
                                </div>

                                <!-- Số điện thoại người nhận -->
                                <div class="single-input-item">
                                    <label for="sdt_nguoi_nhan" class="required">Số Điện Thoại</label>
                                    <input type="text" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan"
                                        value="<?= isset($user['so_dien_thoai']) ? $user['so_dien_thoai'] : '' ?>"
                                        placeholder="Số Điện Thoại" required />
                                </div>

                                <!-- Địa Chỉ người nhận -->
                                <div class="single-input-item">
                                    <label for="dia_chi_nguoi_nhan" class="required">Địa Chỉ</label>
                                    <input type="text" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan"
                                        value="<?= isset($user['dia_chi']) ? $user['dia_chi'] : '' ?>"
                                        placeholder="Địa Chỉ" required />
                                </div>

                                <!-- Ghi chú -->
                                <div class="single-input-item">
                                    <label for="ghi_chu">Ghi Chú</label>
                                    <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="3"
                                        placeholder="Ghi chú nếu có!"></textarea>
                                </div>

                                <!-- Các thông tin ẩn đi để lưu vào bảng don_hangs -->
                                <input type="hidden" name="gio_hang_id" value="<?= $gioHang["id"]?>" />
                                <input type="hidden" name="tong_tien" value="<?= $tong_tien ?>" />
                                <input type="hidden" name="phuong_thuc_thanh_toan_id"
                                    value="<?= $phuong_thuc_thanh_toan_id ?>" />
                                <input type="hidden" name="ngay_dat" value="<?= date('Y-m-d') ?>" />
                                <input type="hidden" name="ma_don_hang" value="DH<?= rand(1000, 9999) ?>" />
                                <!-- Random order code -->
                                <input type="hidden" name="trang_thai_id" value="1" /> <!-- Default status: Pending -->
                                <input type="hidden" name="tai_khoan_id"
                                    value="<?= isset($user['id']) ? $user['id'] : '' ?>" /> <!-- User account ID -->
                            </div>
                        </div>
                    </div>


                    <!-- Thông Tin Sản Phẩm -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Đơn Hàng Của Bạn</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sản Phẩm</th>
                                                <th>Số Lượng</th>
                                                <th>Tổng Tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tongGioHang = 0;
                                            foreach ($chiTietGioHang as $key => $sanPham):
                                                ?>
                                                <tr>
                                                    <td><a href="#"><?= $sanPham['ten_san_pham'] ?></a></td>
                                                    <td><strong>x<?= $sanPham['so_luong'] ?></strong></td>
                                                    <td>
                                                        <?php
                                                        $tongTien = 0;
                                                        if ($sanPham['gia_san_pham']) {
                                                            $tongTien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                        } else {
                                                            $tongTien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                        }
                                                        $tongGioHang += $tongTien;
                                                        echo formatCurrencyVND($tongTien) ;
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Số Cần Tiền Thanh Toán</th>
                                                <th>Thành Tiền</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td>Tiền Sản Phẩm </td>
                                                <td><strong>
                                                        <?= formatCurrencyVND($tongGioHang)  ?>
                                                    </strong></td>
                                            </tr>
                                            <tr>
                                                <td>Phí Vận Chuyển</td>
                                                <td class="d-flex justify-content-center">
                                                    <ul class="shipping-type">
                                                        <strong>30.000 VNĐ</strong>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tổng Hóa Đơn</td>
                                                <input type="hidden" name="tong_tien" value="<?= $tongGioHang + 30000 ?>">
                                                <td><strong><?= formatCurrencyVND($tongGioHang + 30000)  ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method show">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cashon" value="1"
                                                    name="phuong_thuc_thanh_toan_id" class="custom-control-input"
                                                    checked />
                                                <label class="custom-control-label" for="cashon">Thanh Toán Khi Nhận
                                                    Hàng</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required />
                                            <label class="custom-control-label" for="terms">Tôi đồng ý với điều khoản sử
                                                dụng.</a></label>
                                        </div>
                                        <button type="submit" class="btn btn-sqr">Đặt Hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout main wrapper end -->
</main>
<!-- offcanvas mini cart start -->

<!-- offcanvas mini cart end -->
<?php require_once('views/layout/footer.php'); ?>