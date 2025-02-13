<?php
    $model_danh_muc = new AdminDanhMuc(); // khởi tạo đối tượng
    $listDanhMuc = $model_danh_muc->getAllDanhMuc(); // gọi tới function getAllDanhMuc
?>
<!-- Start Header Area -->
<header class="header-area header-wide">
    <!-- main header start -->
    <div class="main-header d-none d-lg-block">
        <!-- header top start -->
        <!-- header middle area start -->
        <div class="header-main-area sticky">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <!-- start logo area -->
                    <div class="col-lg-1">
                        <div class="logo">
                            <a href="<?= BASE_URL ?>">
                                <img src="assets/img/logo/logomixi.png" alt="Brand Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 position-static">
                        <div class="main-menu-area">
                            <div class="main-menu">
                                <!-- main menu navbar start -->
                                <nav class="desktop-menu">
                                    <ul>
                                        <li><a href="<?= BASE_URL ?>">Trang Chủ</a></li>
                                        <li><a href="<?= BASE_URL . "/?act=gioi-thieu" ?>">Giới Thiệu</a>
                                        <li><a href="<?= BASE_URL . "/?act=san-pham" ?>">Sản Phẩm <i
                                                    class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                <?php foreach ($listDanhMuc as $key => $category): ?>
                                                    <li>
                                                        <a
                                                            href="<?= BASE_URL . '?act=san-pham-theo-danh-muc&id_danh_muc=' . $category['id']; ?>">
                                                            <?= htmlspecialchars($category['ten_danh_muc']) ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <li><a href="<?= BASE_URL . "/?act=khuyen-mai" ?>">Khuyến Mãi</a>
                                        <li><a href="<?= BASE_URL . "/?act=tin-tuc" ?>">Tin Tức</a>
                                        <li><a href="<?= BASE_URL . "/?act=lien-he" ?>">Liên Hệ</a>
                                    </ul>
                                </nav>
                                <!-- main menu navbar end -->
                            </div>
                        </div>
                    </div>
                    <!-- main menu area end -->

                    <!-- mini cart area start -->
                    <div class="col-lg-5">
                        <div
                            class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                            <div class="header-search-container">
                                <button class="search-trigger d-xl-none d-lg-block"><i
                                        class="pe-7s-search"></i></button>
                                <form class="header-search-box d-lg-none d-xl-block">
                                    <input type="text" placeholder="Nhập nội dung tìm kiếm" class="header-search-field">
                                    <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <label for="">
                                        <?php if (isset($_SESSION['user_clinet'])) {
                                            echo $_SESSION['user_clinet'];
                                        } ?>
                                    </label>
                                    <li class="user-hover">
                                        <a href="#">
                                            <i class="pe-7s-user"></i>
                                        </a>
                                        <ul class="dropdown-list">
                                            <?php if (!isset($_SESSION['user_clinet'])) { ?>
                                                <li><a href="<?= BASE_URL . '/?act=login' ?>">Đăng Nhập</a></li>
                                                <li><a href="<?= BASE_URL . '/?act=register' ?>">Đăng Ký</a></li>
                                            <?php } else { ?>
                                                <li><a href="<?= BASE_URL . '/?act=form-sua-thong-tin' ?>">Tài Khoản</a>
                                                </li>
                                                <li><a href="<?= BASE_URL . '/?act=lich-su-mua-hang' ?>">Đơn Hàng</a></li>
                                                <li><a href="<?= BASE_URL . '/?act=logout-clinet' ?>">Đăng xuất</a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="<?= BASE_URL . '?act=gio-hang' ?>">
                                            <i class="pe-7s-shopbag"></i>
                                            <!-- <div class="notification">2</div> -->
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header middle area end -->
    </div>
    <!-- main header start -->
</header>
<!-- end Header Area -->