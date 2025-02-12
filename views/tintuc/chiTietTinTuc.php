<?php require_once('./views/layout/header.php'); ?>
<?php require_once('./views/layout/menu.php'); ?>

<div class="container py-5">
    <h2 class="text-center text-primary mb-4">Chi Tiết Tin Tức</h2>
    <div class="card shadow-lg border-0">
       
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="img text-center">
                        <img src="<?= BASE_URL . $tinTucDetail['hinh_anh'] ?>" alt="Hình Ảnh Tin Tức" class="img-fluid rounded shadow">
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="text-primary"><?= htmlspecialchars($tinTucDetail['name']) ?></h3>
                    <p class="mt-3" style="white-space: pre-wrap;">
                        <?= nl2br(htmlspecialchars($tinTucDetail['thong_tin'])) ?>
                    </p>
                    <a href="<?= BASE_URL . '/?act=tin-tuc'?>" class="btn btn-secondary mt-4">
                        <i class="bi bi-arrow-left"></i> Quay Lại
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('./views/layout/footer.php'); ?>