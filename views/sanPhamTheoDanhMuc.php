<?php require_once('layout/header.php'); ?>
<?php require_once('layout/menu.php'); ?>
<main>
    <h2 class="text-center my-4" style="font-size: 28px; font-weight: bold; color: #333;"><?= htmlspecialchars($danhMuc['ten_danh_muc']) ?></h2>
    <div class="row g-4" style="justify-content: center;">
        <?php if (!empty($listSanPham)): ?>
            <?php foreach ($listSanPham as $sanPham): ?>
                <div class="col-md-3 col-sm-6">
                    <div class="product-item" style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background: #fff; transition: transform 0.3s, box-shadow 0.3s; height: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <figure class="text-center" style="margin-bottom: 15px; position: relative; height: 250px;">
                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>" style="text-decoration: none;">
                                <img class="pri-img img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product" style="width: 100%; height: auto; object-fit: contain; max-height: 250px; border-radius: 10px;">
                            </a>
                        </figure>
                        <div class="product-caption text-center" style="margin-top: 15px;">
                            <h6 class="product-name" style="font-size: 16px; font-weight: bold; color: #333; margin-bottom: 10px;">
                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>" style="color: #333; text-decoration: none;"><?= htmlspecialchars($sanPham['ten_san_pham']) ?></a>
                            </h6>
                            <div class="price-box" style="margin-bottom: 15px;">
                                <?php if (!empty($sanPham['gia_khuyen_mai'])): ?>
                                    <span class="price-regular" style="font-size: 16px; color: #e74c3c; font-weight: bold;"><?= formatCurrencyVND($sanPham['gia_khuyen_mai']) ?> </span>
                                    <span class="price-old" style="font-size: 14px; color: #95a5a6; text-decoration: line-through; margin-left: 5px;"><?= formatCurrencyVND($sanPham['gia_san_pham']) ?> </span>
                                <?php else: ?>
                                    <span class="price-regular" style="font-size: 16px; color: #e74c3c; font-weight: bold;"><?= formatCurrencyVND($sanPham['gia_san_pham']) ?> </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>" style="color: white; background: #007bff; padding: 8px 16px; border-radius: 5px; text-decoration: none; display: inline-block; font-size: 14px; font-weight: bold; transition: background 0.3s;">Xem Chi Tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Không có sản phẩm nào trong danh mục này.</p>
        <?php endif; ?>
    </div>
</main>
<!-- Footer -->
<?php require_once('layout/footer.php'); ?>
