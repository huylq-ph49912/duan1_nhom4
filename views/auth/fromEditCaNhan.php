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
                                <li class="breadcrumb-item active" aria-current="page">Tài Khoản</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 500px;">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap sign-up-form">
                            <h5>Thông Tin Tài Khoản</h5>
                            <form action="<?= BASE_URL . '?act=sua-thong-tin' ?>" method="post">
                                <div class="single-input-item">
                                    <input type="text" name="ho_ten" value="<?= $thongTin['ho_ten'] ?>"
                                        placeholder="Nhập Họ Tên" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="date" name="ngay_sinh" value="<?= $thongTin['ngay_sinh'] ?>"
                                        placeholder="Nhập Ngày Sinh" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="text" name="so_dien_thoai" value="<?= $thongTin['so_dien_thoai'] ?>"
                                        placeholder="Nhập Số Điện Thoại" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="text" name="gioi_tinh" value="<?= $thongTin['gioi_tinh'] ?>"
                                        placeholder="Nhập Giới Tính" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="text" name="dia_chi" value="<?= $thongTin['dia_chi'] ?>"
                                        placeholder="Nhập Địa Chỉ" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="email" name="email" value="<?= $thongTin['email'] ?>"
                                        placeholder="Nhập email" readonly>
                                </div>
                                <div class="single-input-item">
                                    <button type="submit" class="btn btn-sqr">Cập Nhật</button><br><br>
                                    <a href="<?= BASE_URL . '?act=doi-mat-khau' ?>">Đổi Mật Khẩu</a>
                                </div>
                            </form>
                            <?php if (isset($_SESSION['errors'])): ?>
                                <p class="error-message"><?= $_SESSION['errors'];
                                unset($_SESSION['errors']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once('views/layout/footer.php'); ?>