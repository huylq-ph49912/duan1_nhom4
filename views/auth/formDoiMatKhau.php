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
                            <li class="breadcrumb-item active" aria-current="page">Đổi Mật Khẩu</li>
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
            <div class="col-lg-12">
                <div class="login-reg-form-wrap">
                    <h5>Đổi Mật Khẩu</h5>
                    <form action="<?= BASE_URL . '?act=sua-mat-khau' ?>" method="post">
                                <div class="single-input-item">
                                    <label for="old_password">Mật khẩu cũ</label>
                                    <input type="password" id="old_password" name="old_password" placeholder="Nhập mật khẩu cũ" required>
                                </div>
                                <div class="single-input-item">
                                    <label for="new_password">Mật khẩu mới</label>
                                    <input type="password" id="new_password" name="new_password" placeholder="Nhập mật khẩu mới" required>
                                </div>
                                <div class="single-input-item">
                                    <label for="confirm_password">Xác nhận mật khẩu mới</label>
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu mới" required>
                                </div>
                                <div class="single-input-item">
                                    <button type="submit" class="btn btn-sqr">Đổi Mật Khẩu</button>
                                </div>
                            </form>
                            <?php if (isset($_SESSION['errors'])): ?>
                                <p class="error-message" style="color: red;"><?= $_SESSION['errors'];
                                    unset($_SESSION['errors']); ?></p>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['success'])): ?>
                                <p class="success-message" style="color: green;"><?= $_SESSION['success'];
                                    unset($_SESSION['success']); ?></p>
                            <?php endif; ?>

                </div>

            </div>
        </div>

    </div>

</div>
    </div>
</main>
<?php require_once('views/layout/footer.php'); ?>