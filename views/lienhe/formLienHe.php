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
                            <li class="breadcrumb-item active" aria-current="page">Liên Hệ</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="page_contact section ">
    <style>
        /* Tổng quan */
        .page_contact {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .title_page {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }

        .single-contact {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .single-contact i {
            font-size: 1.5rem;
            color: #007bff;
            margin-right: 15px;
        }

        .single-contact .content span,
        .single-contact .content a {
            font-weight: bold;
            color: #333;
        }

        .single-contact .content a:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        #pagelogin {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
        }

        .title-head {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Biểu mẫu liên hệ */
        form .form-group {
            margin-bottom: 15px;
        }

        form .form-group label {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        form .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            font-size: 1rem;
            width: 100%;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }

        form .form-control:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        form .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .title_page {
                font-size: 1.5rem;
            }

            .title-head {
                font-size: 1.3rem;
            }

            .single-contact {
                font-size: 0.9rem;
            }

            form .form-control {
                font-size: 0.9rem;
                padding: 8px;
            }

            form .btn-primary {
                font-size: 0.9rem;
                padding: 8px 12px;
            }
        }
    </style>
    <div class="container py-3">
        <div class="row" style="justify-content: center;">
            <div class="col-lg-6 col-12">
                <div class="left-contact px-lg-2">
                    <h1 class="title_page mb-3">MixiShop Liên Hệ</h1>
                    <div class="single-contact">
                        <div class="content">Địa chỉ:
                            <span>Cao Đẳng FPT, Hà Nội</span>
                        </div>
                    </div>
                    <div class="single-contact">
                        <div class="content">
                            Số điện thoại: 0789182477
                        </div>
                    </div>
                    <div class="single-contact">
                        <div class="content">
                            Email: <a href="mailto:Mixiishop@gmail.com">Mixiishop@gmail.com</a>
                        </div>
                    </div>
                    <div id="pagelogin" class="pt-3 mt-3 border-top">
                        <div class="container mt-5">
                            <h2 class="title-head">Liên hệ với chúng tôi</h2>
                            <?php if (isset($_SESSION['message'])): ?>
                                <div class="alert alert-info">
                                    <?= $_SESSION['message'];
                                    unset($_SESSION['message']); ?>
                                </div>
                            <?php endif; ?>
                            <form method="POST" action="index.php?act=gui-lien-he">
                                <div class="form-group">
                                    <label for="ten_lien_he">Họ và tên</label>
                                    <input type="text" name="ten_lien_he" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="thong_tin">Nội dung liên hệ</label>
                                    <textarea name="thong_tin" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi liên hệ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include './views/layout/footer.php'; ?>
