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
                            <li class="breadcrumb-item active" aria-current="page">Khuyến Mãi</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Wrapper. Contains page content -->
<!-- CSS -->
<!-- Main Content -->
<main class="container my-5">
    <div class="row">
        <?php foreach ($listKhuyenMai as $key => $khuyenMai): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-body">
                        <h5 class="card-title text-primary" style="font-size: 1.25rem; font-weight: bold;">
                            <?= htmlspecialchars($khuyenMai['ten_khuyen_mai']) ?>
                        </h5>
                        <p class="card-text" style="font-size: 1rem; color: #555;">Giảm giá: <strong
                                style="color: #e74c3c;"><?= htmlspecialchars($khuyenMai['gia_tri']) ?>%</strong></p>
                        <div class="alert alert-secondary text-center" id="promo-code-<?= $khuyenMai['id'] ?>"
                            style="font-size: 1.125rem; font-weight: bold; background-color: #f7f7f7; border: 1px solid #ccc; border-radius: 5px;">
                            <?= htmlspecialchars($khuyenMai['ma_khuyen_mai']) ?>
                        </div>
                        <button class="btn btn-primary btn-sm"
                            style="align-self: flex-start; margin-top: auto; font-size: 14px; padding: 8px 16px; border-radius: 5px; background-color: #007bff; color: white; transition: background-color 0.3s;"
                            onclick="copyToClipboard(<?= $khuyenMai['id'] ?>)">
                            <i class="bi bi-clipboard mr-2"></i> Sao chép mã
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<!-- Thêm đoạn CSS dưới đây vào phần <style> hoặc vào tệp CSS riêng -->
<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .alert {
        font-size: 1.125rem;
        font-weight: bold;
        background-color: #f7f7f7;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn-gradient {
        background: linear-gradient(90deg, rgba(34, 193, 195, 1) 0%, rgba(45, 168, 81, 1) 100%);
        border: none;
        font-size: 1rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-gradient:hover {
        background: linear-gradient(90deg, rgba(34, 193, 195, 1) 20%, rgba(45, 168, 81, 1) 80%);
    }

    .bi-clipboard {
        font-size: 1.2rem;
        margin-right: 10px;
    }
</style>

<?php
include './views/layout/footer.php';
?>
<!-- End Footer -->
<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false
        });
    });
    function copyToClipboard(promoId) {
        var promoCodeElement = document.getElementById("promo-code-" + promoId);
        var promoCode = promoCodeElement.textContent || promoCodeElement.innerText;

        // Tạo một textarea ẩn để sao chép văn bản
        var textarea = document.createElement("textarea");
        textarea.value = promoCode;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy");
        document.body.removeChild(textarea);

        // Thông báo khi sao chép thành công
        alert("Đã sao chép mã khuyến mãi: " + promoCode);
    }
</script>

</body>

</html>