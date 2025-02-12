<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'du_an_1');

// Kiểm tra kết nối
if ($conn->connect_error) {
    die('Kết nối thất bại: ' . $conn->connect_error);
}
$binhLuanList = [];
$sanPhamLienQuan = [];

// Lấy thông tin sản phẩm
if (isset($sanPham['id'])) {
    $sanPhamId = (int) $sanPham['id'];

    // Câu truy vấn để lấy đánh giá
    $stmt = $conn->prepare("
            SELECT 
                dg.noi_dung, 
                dg.diem_danh_gia, 
                dg.created_at, 
                COALESCE(tk.ho_ten, 'Ẩn danh') AS ho_ten 
            FROM danh_gias dg
            LEFT JOIN tai_khoans tk ON dg.nguoi_dung_id = tk.id
            WHERE dg.san_pham_id = ?
            ORDER BY dg.created_at DESC
        ");
    $stmt->bind_param("i", $sanPhamId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $danhGiaList = $result->fetch_all(MYSQLI_ASSOC);
    }

    // Truy vấn bình luận chỉ lấy những bình luận có trạng thái = 1
    $stmt = $conn->prepare("
            SELECT 
                bl.noi_dung, 
                bl.created_at, 
                COALESCE(tk.ho_ten, 'Ẩn danh') AS ho_ten 
            FROM binh_luans bl
            LEFT JOIN tai_khoans tk ON bl.nguoi_dung_id = tk.id
            WHERE bl.san_pham_id = ? AND bl.trang_thai = 1
            ORDER BY bl.created_at DESC
        ");
    $stmt->bind_param("i", $sanPhamId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $binhLuanList = $result->fetch_all(MYSQLI_ASSOC);
    }

    // Truy vấn sản phẩm liên quan
    if (isset($sanPham['danh_muc_id'])) {
        $danhMucId = (int) $sanPham['danh_muc_id'];
        $stmt = $conn->prepare("SELECT * FROM san_phams WHERE danh_muc_id = ? AND id != ? LIMIT 4");
        $stmt->bind_param("ii", $danhMucId, $sanPhamId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $sanPhamLienQuan = $result->fetch_all(MYSQLI_ASSOC);
        }
    }
}

// Xử lý dữ liệu gửi từ form bình luận
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'], $_POST['san_pham_id'])) {
    $noiDung = $conn->real_escape_string($_POST['comment']);
    $sanPhamId = (int) $_POST['san_pham_id'];
    $nguoiDungId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Kiểm tra xem người dùng đã đăng nhập chưa
    if ($nguoiDungId) {
        $stmt = $conn->prepare("INSERT INTO binh_luans (noi_dung, san_pham_id, nguoi_dung_id, created_at, trang_thai) VALUES (?, ?, ?, NOW(), 1)");
        $stmt->bind_param("sii", $noiDung, $sanPhamId, $nguoiDungId);

        if ($stmt->execute()) {
            // Quay lại trang chi tiết sản phẩm
            header("Location: " . BASE_URL . "/?act=chi-tiet-san-pham&id_san_pham=" . $sanPhamId);
            exit();
        } else {
            echo '<div class="alert alert-danger">Lỗi: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Bạn cần đăng nhập để bình luận!</div>';
    }
}

$conn->close();
?>
<?php require_once('layout/header.php'); ?>
<?php require_once('layout/menu.php'); ?>
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Sản Phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi Tiết Sản Phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->
    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- Thông Tin Chi Tiết -->
                    <div class="product-details-inner">
                        <div class="row">
                            <!-- Ảnh Sản Phẩm -->
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <?php foreach ($listAnhSanPham as $key => $anhSanPham): ?>
                                        <div class="pro-large-img img-zoom">
                                            <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product-details" />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <?php foreach ($listAnhSanPham as $key => $anhSanPham): ?>
                                        <div class="pro-large-img img-zoom">
                                            <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?>"
                                                alt="product-details" />
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href="#"><?= $sanPham['ten_danh_muc'] ?></a>
                                    </div>
                                    <h3 class="product-name">Tên Sản Phẩm: <?= $sanPham['ten_san_pham'] ?></h3>
                                    <div class="price-box">
                                        <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                            <span class="price-regular">Giá Bán:
                                                <?= formatCurrencyVND($sanPham['gia_khuyen_mai']); ?></span>
                                            <span
                                                class="price-old"><del><?= formatCurrencyVND($sanPham['gia_san_pham']); ?></del></span>
                                        <?php } else { ?>
                                            <span
                                                class="price-regular"><?= formatCurrencyVND($sanPham['gia_san_pham']); ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span>Trong Kho: <?= $sanPham['so_luong']; ?></span>
                                    </div>
                                    <p class="pro-desc">Mô Tả: <?= $sanPham['mo_ta']; ?></p>
                                    <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="post">
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">Số lượng:</h6>
                                            <div class="quantity">
                                                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id'] ?>">
                                                <div class="pro-qty"><input type="number"
                                                        max="<?= $sanPham['so_luong'] ?>" value="1" name="so_luong">
                                                </div>
                                            </div>
                                            <div class="action_link">
                                                <button class="btn btn-cart2">Thêm Vào Giỏ Hàng</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Bình Luận -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <!-- Bình Luận -->
                            <div class="col-lg-12" style="padding: 20px; border-right: 1px solid #ddd;">
                                <h3 class="text-secondary"
                                    style="font-size: 24px; font-weight: bold; margin-bottom: 20px; color: #333;">
                                    Bình luận
                                </h3>
                                <!-- Form Bình Luận -->
                                <?php if (isset($_SESSION['user_clinet'])): ?>
                                    <form action="<?= BASE_URL . '/?act=chi-tiet-san-pham&id_san_pham=' . $sanPhamId ?>"
                                        method="post" class="mb-4" style="margin-bottom: 20px;">
                                        <textarea name="comment" rows="4" class="form-control"
                                            placeholder="Nhập bình luận của bạn..." required
                                            style="border: 1px solid #ccc; border-radius: 8px; padding: 10px; font-size: 16px;"></textarea>
                                        <input type="hidden" name="san_pham_id" value="<?= $sanPhamId ?>">
                                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm mt-3"
                                            style="background-color: #007bff; color: white; border: none; padding: 10px 20px; font-size: 16px;">
                                            <i class="fa fa-paper-plane"></i> Gửi Bình Luận
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <div class="alert alert-warning" role="alert"
                                        style="background-color: #fff3cd; color: #856404; padding: 10px; border-radius: 8px;">
                                        Bạn cần <a href="<?= BASE_URL . '?act=login' ?>" style="color: #007bff;">đăng
                                            nhập</a> để bình luận!
                                    </div>
                                <?php endif; ?>

                                <div class="list-group shadow-sm"
                                    style="background-color: #f9f9f9; border-radius: 8px; padding: 10px;">
                                    <?php if (empty($binhLuanList)): ?>
                                        <div class="list-group-item text-center" style="border: none; color: #999;">
                                            <p class="text-muted" style="font-size: 16px;">Chưa có bình luận nào.</p>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($binhLuanList as $binhLuan): ?>
                                            <div class="list-group-item" style="border-bottom: 1px solid #ddd; padding: 15px;">
                                                <strong
                                                    style="color: #333;"><?= htmlspecialchars($binhLuan['ho_ten']) ?></strong>
                                                <small class="text-muted float-end"
                                                    style="color: #666;"><?= htmlspecialchars($binhLuan['created_at']) ?></small>
                                                <p class="mb-0" style="margin-top: 10px; color: #555;">
                                                    <?= htmlspecialchars($binhLuan['noi_dung']) ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sản Phẩm Liên Quan -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản Phẩm Liên Quan</h2>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">

                <?php foreach ($listSanPhamCungDanhMuc as $key => $sanPham): ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="product-item">
                            <figure class="product-thumb">
                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                </a>
                                <div class="product-badge">
                                    <?php
                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                    $ngayHienTai = new DateTime();
                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);
                                    if ($tinhNgay->days <= 7) { ?>
                                        <div class="product-label new">
                                            <span>Mới</span>
                                        </div>
                                    <?php }
                                    if ($sanPham['gia_khuyen_mai']) { ?>
                                        <div class="product-label discount">
                                            <span>Giảm Giá</span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </figure>
                            <div class="product-caption">
                                <h6 class="product-name">
                                    <a
                                        href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                </h6>
                                <div class="price-box">
                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                        <span class="price-regular"><?= formatCurrencyVND($sanPham['gia_khuyen_mai']); ?></span>
                                        <span
                                            class="price-old"><del><?= formatCurrencyVND($sanPham['gia_san_pham']); ?></del></span>
                                    <?php } else { ?>
                                        <span class="price-regular"><?= formatCurrencyVND($sanPham['gia_san_pham']); ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<!-- offcanvas mini cart end -->
<?php require_once('layout/footer.php'); ?>