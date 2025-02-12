<?php require_once('views/layout/header.php'); ?>
<?php require_once('views/layout/menu.php'); ?>
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tin Tức</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- News Section -->
<div id="news" class="container py-5">
    <h2 class="text-center text-primary mb-4" style="font-size: 28px; font-weight: bold; color: #333;">Danh Sách Tin Tức
    </h2>
    <div class="row">
        <?php foreach ($listTinTuc as $tinTuc): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm"
                    style="border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; transition: all 0.3s ease; display: flex; flex-direction: column; height: 100%;">
                    <div class="card-body"
                        style="padding: 20px; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
                        <div class="imgg">
                            <img src="<?= BASE_URL . $tinTuc['hinh_anh'] ?>"
                                style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px;">
                        </div>
                        <h5 class="card-title" style="font-size: 18px; font-weight: bold; color: #333; margin-top: 15px;">
                            <?= htmlspecialchars($tinTuc['name']) ?>
                        </h5>
                        <p class="card-text text-muted" style="font-size: 14px; color: #6c757d; margin-bottom: 15px;">
                            <?= htmlspecialchars(mb_strimwidth($tinTuc['thong_tin'], 0, 100, '...')) ?>
                        </p>
                        <a href="<?= BASE_URL . '/?act=chiTietTinTuc' . '&id=' . $tinTuc['id'] ?>"
                            class="btn btn-primary btn-sm"
                            style="align-self: flex-start; margin-top: auto; font-size: 14px; padding: 8px 16px; border-radius: 5px; background-color: #007bff; color: white; transition: background-color 0.3s;">
                            Xem Chi Tiết
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Footer -->
<?php include './views/layout/footer.php'; ?>
<!-- End Footer -->