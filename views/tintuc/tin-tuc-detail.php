<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi Tiết Tin Tức</h1>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h3><?= htmlspecialchars($tinTucDetail['name']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($tinTucDetail['thong_tin'])) ?></p>
                    <a href="<?= BASE_URL_ADMIN . '/?act=quan-ly-tin-tuc' ?>" class="btn btn-primary">Quay Lại</a>
                </div>
            </div>
        </div>
    </section>
</div>
