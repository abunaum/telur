<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>LEGI JAYA FARM</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/legijaya.jpeg'); ?>" rel="icon">
    <link href="<?= base_url('assets/img/legijaya.jpeg'); ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Extends CSS Files -->
    <link href="<?= base_url('assets/extends/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/extends/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/extends/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/extends/quill/quill.snow.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/extends/quill/quill.bubble.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/extends/remixicon/remixicon.css'); ?>" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">

    <!-- Script -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?= $this->renderSection('head'); ?>
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url(); ?>" class="logo d-flex align-items-center">
                <img src="<?= base_url('assets/img/legijaya.jpeg'); ?>" alt="">
                <span class="d-none d-lg-block"><?= $namaweb; ?></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <?= $this->include('panel/navbar') ?>

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?= $this->include('panel/sidebar') ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><?= $halaman; ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?= $halaman; ?></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <?= $this->renderSection('content'); ?>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Unuja</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://google.com/">Afif Rizal Muhaimin</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Extends JS Files -->
    <script src="<?= base_url('assets/extends/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/extends/quill/quill.min.js'); ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('assets/js/main.js'); ?>"></script>
    <?= $this->renderSection('script'); ?>

</body>

</html>
<!-- end document-->