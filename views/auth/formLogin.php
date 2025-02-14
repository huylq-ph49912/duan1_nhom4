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
                                <li class="breadcrumb-item active" aria-current="page">Đăng Nhập</li>
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
                        <div class="login-reg-form-wrap">
                            <h5> Đăng Nhập</h5>
                            <?php if (isset($_SESSION['errors'])): ?>
                                <div class="alert alert-danger">
                                    <?= $_SESSION['errors']; ?>
                                </div>     
                                <?php endif; ?>
                                <form action="<?= BASE_URL . '?act=check-login' ?>" method="post">
                                <div class="single-input-item">
                                    <input type="email" placeholder="Xin mời nhập email..." name="email" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="password" placeholder="Vui lòng nhập mật khẩu..." name="password"
                                        required />
                                </div>
                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <a href="<?= BASE_URL . '/?act=register'?>" class="forget-pwd">Bạn chưa có tài khoản?</a>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Đăng Nhập</button>
                                </div>
                            </form>
                            <?php if (isset($_SESSION['errors'])): ?>
                                <p class="error-message"><?= $_SESSION['errors'];
                                unset($_SESSION['errors']); ?></p>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['register_success'])): ?>
                                <p class="success-message">
                                    <?= $_SESSION['register_success'];
                                    unset($_SESSION['register_success']); ?></p>
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