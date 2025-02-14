<?php require_once('views/layout/header.php'); ?>
<?php require_once('views/layout/menu.php'); ?>
<main>
<div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đăng Ký</li>
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
                    <!-- Register Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap sign-up-form">
                            <h5>Đăng Ký</h5> 
                            <form action="<?= BASE_URL . '?act=check-register' ?>" method="post">
                                <div class="single-input-item">
                                    <input type="text" name="ho_ten" placeholder="Nhập Họ Tên" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="date" name="ngay_sinh" placeholder="Nhập Ngày Sinh" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="text" name="so_dien_thoai" placeholder="Nhập Số Điện Thoại" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="text" name="gioi_tinh" placeholder="Nhập Giới Tính (Nam/Nữ)" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="text" name="dia_chi" placeholder="Nhập Địa Chỉ" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="email" name="email" placeholder="Nhập Email" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="password" name="password" placeholder="Nhập Mật Khẩu" required>
                                </div>
                                <div class="single-input-item">
                                    <input type="password" name="confirm_password" placeholder="Xác Nhận Mật Khẩu"
                                        required>
                                </div>
                                <div class="single-input-item">
                                    <button type="submit" class="btn btn-sqr">Đăng Ký</button>
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
<?php require_once('views/layout/miniCart.php'); ?>