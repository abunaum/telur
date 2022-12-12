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
    <style type="text/css" media="print">
        @page {
            size: auto;
            /* auto is the current printer page size */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }

        body {
            background-color: #FFFFFF;
            border: solid 1px black;
            margin: 0px;
            /* the margin on the content before printing */
        }
    </style>

    <?= $this->renderSection('head'); ?>
</head>

<body onload="window.print()">

    <!-- ======= Content ======= -->
    <?= $this->renderSection('content'); ?>

    <!-- Extends JS Files -->
    <script src="<?= base_url('assets/extends/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/extends/quill/quill.min.js'); ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('assets/js/main.js'); ?>"></script>
    <?= $this->renderSection('script'); ?>

</body>

</html>
<!-- end document-->