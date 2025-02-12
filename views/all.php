<?php require_once('layout/header.php'); ?>
<?php require_once('layout/menu.php'); ?>

<div class="breadcrumb-area">
<div class="container">
    <div class="row">
<div class="col-12">
<div class="breadcrumb-wrap">
<nav aria-label="breadcrumb">
    <ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
    </ul>
</nav>
</div>
</div>
    </div>
</div>
</div><br>
<div class="row">
    <div class="col-12">
        <div class="section-title text-center" style="margin-bottom: 30px;"> 
        <h2 class="title" style="font-size: 28px; font-weight: bold; color: #333;">Tất Cả Sản Phẩm</h2>
        </div>
    </div>
</div><br>
<main>
    <div class="filter-form">
        <form action="<?= BASE_URL ?>" method="get" class="d-flex align-items-center justify-content-start flex-wrap">
            <input type="hidden" name="act" value="tim-kiem">
            <!-- Danh mục -->
            <div class="form-group mb-3">
                <label for="category" class="form-label">Danh mục:</label>
                <select name="danh_muc" id="category" class="form-select rounded-pill">
                    <option value="all">Tất cả</option>
                    <?php foreach ($listDanhMuc as $danhMuc): ?>
                        <option value="<?= $danhMuc['id'] ?>" <?= isset($_GET['danh_muc']) && $_GET['danh_muc'] == $danhMuc['id'] ? 'selected' : '' ?>>
                            <?= $danhMuc['ten_danh_muc'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Mức giá -->
            <div class="form-group mb-3">
                <label for="price-range" class="form-label">Mức giá:</label>
                <select name="muc_gia" id="price-range" class="form-select rounded-pill">
                    <option value="all">Tất cả</option>
                    <option value="0-150000" <?= isset($_GET['muc_gia']) && $_GET['muc_gia'] == '0-150000' ? 'selected' : '' ?>>
                        0 - 150,000 VNĐ
                    </option>
                    <option value="150000-300000" <?= isset($_GET['muc_gia']) && $_GET['muc_gia'] == '150000-300000' ? 'selected' : '' ?>>
                        150,000 - 300,000 VNĐ
                    </option>
                    <option value="300000-500000" <?= isset($_GET['muc_gia']) && $_GET['muc_gia'] == '300000-500000' ? 'selected' : '' ?>>
                        300,000 - 500,000 VNĐ
                    </option>
                </select>
            </div>

            <!-- Nút tìm kiếm -->
            <div class="d-grid mx-2">
                <button type="submit" class="btn btn-gradient shadow-lg">
                    <i class="fa fa-search me-2"></i> Tìm kiếm
                </button>
            </div>
        </form>
    </div>
    <div class="row g-4">
        <!-- Tất Cả Sản Phẩm -->
        <?php if (!empty($sanPhamList)): ?>
            <?php foreach ($sanPhamList as $sanPham): ?>
                <div class="col-md-3 col-sm-6">
                    <div class="product-item border rounded p-3 h-100">
                        <figure class="text-center">
                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                <img class="pri-img img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                    alt="<?= htmlspecialchars($sanPham['ten_san_pham']) ?>" style="width: 300px; height: auto;">
                            </a>
                        </figure>
                        <div class="product-caption text-center">
                            <h6 class="product-name">
                                <a
                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>"><?= htmlspecialchars($sanPham['ten_san_pham']) ?></a>
                            </h6>
                            <div class="price-box">
                                <?php if (!empty($sanPham['gia_khuyen_mai'])): ?>
                                    <span
                                        class="price-regular text-danger fw-bold"><?= formatCurrencyVND($sanPham['gia_khuyen_mai']) ?>
                                    </span>
                                    <span
                                        class="price-old text-muted text-decoration-line-through ms-2"><?= formatCurrencyVND($sanPham['gia_san_pham']) ?>
                                    </span>
                                <?php else: ?>
                                    <span
                                        class="price-regular text-danger fw-bold"><?= formatCurrencyVND($sanPham['gia_san_pham']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <!--Sản Phẩm Đã Lọc -->
        <?php if (!empty($listSanPham)): ?>
            <?php foreach ($listSanPham as $sanPham): ?>
                <div class="col-md-3 col-sm-6">
                    <div class="product-item border rounded p-3 h-100">
                        <figure class="text-center">
                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                <img class="pri-img img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                    alt="<?= $sanPham['ten_san_pham'] ?>" style="width: 300px; height: auto;">
                            </a>
                        </figure>
                        <div class="product-caption text-center">
                            <h6 class="product-name">
                                <a
                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>"><?= htmlspecialchars($sanPham['ten_san_pham']) ?></a>
                            </h6>
                            <div class="price-box">
                                <?php if ($sanPham['gia_khuyen_mai']): ?>
                                    <span class="price-regular text-danger fw-bold"><?= number_format($sanPham['gia_khuyen_mai']) ?>
                                        VNĐ</span>
                                    <span class="price-old text-muted text-decoration-line-through ms-2"><del><?= number_format($sanPham['gia_san_pham']) ?>
                                            VNĐ</del></span>
                                <?php else: ?>
                                    <span class="price-regular text-danger fw-bold"><?= number_format($sanPham['gia_san_pham']) ?>
                                        VNĐ</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Không tìm thấy sản phẩm phù hợp.</p>
        <?php endif; ?>
    </div>
</main>
<?php require_once('layout/footer.php'); ?>
<style>
    .filter-form form {
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .filter-form .form-group {
        margin-right: 15px;
        margin-bottom: 10px;
    }

    .filter-form label {
        font-weight: bold;
        color: #333;
        font-size: 14px;
    }

    .filter-form select {
        width: 180px;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background-color: #fff;
        font-size: 14px;
    }

    .filter-form .btn {
        padding: 10px 25px;
        font-size: 14px;
        border-radius: 6px;
        background-color: #007bff;
        color: #fff;
        border: none;
        transition: background-color 0.3s;
    }

    .filter-form .btn:hover {
        background-color: #0056b3;
    }

    .product-item {
        position: relative;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 6px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
        margin-bottom: 20px;
    }

    .product-item:hover {
        transform: translateY(-5px);
    }

    .product-item figure img {
        width: 100%;
        height: auto;
        border-radius: 6px;
        transition: transform 0.3s ease-in-out;
    }

    .product-item:hover figure img {
        transform: scale(1.03);
    }

    .product-caption {
        padding: 10px;
        text-align: center;
    }

    .product-caption h6 {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }

    .price-box {
        margin-top: 8px;
    }

    .price-regular {
        font-size: 16px;
        color: #e74c3c;
        font-weight: bold;
    }

    .price-old {
        font-size: 14px;
        color: #7f8c8d;
        text-decoration: line-through;
        margin-left: 8px;
    }

    .product-item:hover .price-regular {
        color: #2980b9;
    }

    .section-title h2 {
        font-size: 28px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .breadcrumb-area {
        background-color: #f1f1f1;
        padding: 10px 0;
    }

    .breadcrumb-area .breadcrumb {
        background-color: transparent;
        margin-bottom: 0;
    }

    .breadcrumb-area .breadcrumb-item a {
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb-area .breadcrumb-item.active {
        color: #333;
    }

    @media (max-width: 767px) {
        .filter-form form {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-form .form-group {
            margin-right: 0;
            width: 100%;
        }

        .filter-form .btn {
            width: 100%;
        }

        .product-item {
            margin-bottom: 15px;
        }

        .product-item img {
            max-width: 100%;
        }

        .section-title h2 {
            font-size: 24px;
        }
    }
</style>