<?php require_once('./views/layout/header.php'); ?>
<?php require_once('./views/layout/menu.php'); ?>
<?php if (isset($_SESSION['success_message'])): ?>
    <div
        style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin: 10px 0;">
        <?= $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
<main>
    <!-- banner -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- Lặp qua danh sách banner -->
            <?php foreach ($listBanner as $banner): ?>
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img">
                        <img src="<?= BASE_URL . $banner['hinh_anh'] ?>" style="width: 1990px;">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <!-- Hệ Thống -->
    <section class="section awe-section-2 section-section_policies">
        <div class="service-policy section-padding">
            <div class="container">
                <div class="row mtn-30">
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-plane"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Vận Chuyển Toàn Quốc</h6>
                                <p>Vận Chuyển Nhanh Chóng</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-help2"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Ưu Đãi Hấp Dẫn</h6>
                                <p>Nhiều ưu đãi khuyến mãi hot</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-back"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Bảo đảm chất lượng</h6>
                                <p>Sản phẩm đã được kiểm định</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-credit"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Hotline: 0822221992</h6>
                                <p>Vui lòng gọi hotline để hỗ trợ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <!-- danh mục sản phẩm -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <?php
            require_once('views/danhmuc/listDanhMuc.php');
            ?>
        </div>
    </section>
    <!-- Sản Phẩm -->
    <section class="product-area section-padding" style="padding: 40px 0; background-color: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section title -->
                    <div class="section-title text-center" style="margin-bottom: 30px;">
                        <h2 class="title" style="font-size: 28px; font-weight: bold; color: #333;">Sản Phẩm Dành Cho Bạn
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">
                        <!-- Product tab content -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style"
                                    style="display: flex; flex-wrap: wrap; gap: 20px;">
                                    <?php if (!empty($listSanPham)): ?>
                                        <?php foreach ($listSanPham as $key => $sanPham): ?>
                                            <div class="col-md-3 col-sm-6 mb-4" style="flex: 0 0 calc(25% - 20px);">
                                                <div class="product-item"
                                                    style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; background: #fff; transition: transform 0.3s, box-shadow 0.3s; height: 100%;">
                                                    <figure class="product-thumb"
                                                        style="position: relative; text-align: center; margin-bottom: 15px; overflow: hidden; border-radius: 10px;">
                                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>"
                                                            style="text-decoration: none;">
                                                            <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product"
                                                                style="width: 100%; height: 250px; object-fit: cover;">
                                                        </a>
                                                        <div class="product-badge"
                                                            style="position: absolute; top: 10px; left: 10px; display: flex; gap: 5px;">
                                                            <?php
                                                            $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                            $ngayHienTai = new DateTime();
                                                            $tinhNgay = $ngayHienTai->diff($ngayNhap);
                                                            if ($tinhNgay->days <= 7) { ?>
                                                                <div class="product-label new"
                                                                    style="background: #ff5252; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 12px;">
                                                                    Mới</div>
                                                            <?php }
                                                            if ($sanPham['gia_khuyen_mai']) { ?>
                                                                <div class="product-label discount"
                                                                    style="background: #27ae60; color: #fff; padding: 2px 8px; border-radius: 4px; font-size: 12px;">
                                                                    Giảm Giá</div>
                                                            <?php } ?>
                                                        </div>
                                                    </figure>
                                                    <div class="product-caption" style="text-align: center;">
                                                        <h6 class="product-name"
                                                            style="font-size: 16px; font-weight: bold; color: #333; margin-bottom: 10px;">
                                                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>"
                                                                style="color: #333; text-decoration: none;"><?= $sanPham['ten_san_pham'] ?></a>
                                                        </h6>
                                                        <div class="price-box" style="margin-bottom: 15px;">
                                                            <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                                <span class="price-regular"
                                                                    style="font-size: 14px; color: #27ae60; font-weight: bold;">
                                                                    <?= formatCurrencyVND($sanPham['gia_khuyen_mai']); ?>
                                                                </span>
                                                                <span class="price-old"
                                                                    style="font-size: 12px; color: #999; text-decoration: line-through; margin-left: 5px;">
                                                                    <?= formatCurrencyVND($sanPham['gia_san_pham']); ?></span>
                                                            <?php } else { ?>
                                                                <span class="price-regular"
                                                                    style="font-size: 14px; color: #333; font-weight: bold;">
                                                                    <?= formatCurrencyVND($sanPham['gia_san_pham']); ?>
                                                                </span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div style="text-align: center;">
                                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>"
                                                            style="color: white; background: #007bff; padding: 8px 16px; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 14px; font-weight: bold; transition: background 0.3s;">
                                                            Xem Chi Tiết
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p style="text-align: center; color: #999;">Không có sản phẩm nào để hiển thị.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Banner dưới -->
    <div class="banner-statistics-area" style="padding: 20px 0;">
        <div class="container">
            <div class="row row-20" style="margin-left: -10px; margin-right: -10px;">
                <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                    <figure class="banner-statistics"
                        style="position: relative; overflow: hidden; border-radius: 8px; margin-top: 20px;">
                        <a href="#">
                            <img src="assets/img/banner/1.jpg" alt="product banner"
                                style="width: 100%; height: auto; object-fit: cover; border-radius: 8px;">
                        </a>
                    </figure>
                </div>
                <div class="col-sm-6" style="padding-left: 10px; padding-right: 10px;">
                    <figure class="banner-statistics"
                        style="position: relative; overflow: hidden; border-radius: 8px; margin-top: 20px;">
                        <a href="#">
                            <img src="assets/img/banner/2.jpg" alt="product banner"
                                style="width: 100%; height: auto; object-fit: cover; border-radius: 8px;">
                        </a>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- Band logo -->
    <div class="brand-logo section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-logo-carousel slick-row-10 slick-arrow-style">
                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/1.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/2.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/3.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/4.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/5.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/6.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once('./views/layout/footer.php'); ?>