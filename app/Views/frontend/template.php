<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php
    helper('auth');
    $uri = service('uri');
    $current_uris = [
        'segment_1' => $uri->getSegment(1),
    ];
    ?>
    <title><?= isset($title) ? $title : 'Default Title' ?> - Panel Admin</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>frontend/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>frontend/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>frontend/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url(); ?>frontend/assets/img/favicon/site.webmanifest">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(); ?>frontend/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>frontend/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url(); ?>frontend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>frontend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>frontend/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>frontend/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url(); ?>frontend/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="<?= base_url(); ?>frontend/sweetalert2/sweetalert2.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>frontend/assets/css/style.css" rel="stylesheet">

    <script src="<?= base_url('frontend/jquery/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.1.0/dist/css/glightbox.min.css">
    <!-- =======================================================
  * Template Name: Company
  * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .text-muted {
            font-size: 12px;
            color: #fcf0f6;
        }

        #header a.btn.btn-primary.mx-4.p-2.text-white {
            background-color: #116db6;
        }

        #header a.btn.btn-primary.mx-4.p-2.text-white:hover {
            color: #fff !important;
        }

        #blog .entry-img {
            position: relative;
        }

        #blog .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #blog .entry-img:hover .overlay {
            opacity: 1;
        }

        #blog .overlay i {
            font-size: 2rem;
        }

        #blog .overlay span {
            margin-top: 0.5rem;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <!-- <h1 class="logo me-auto"><a href="index.html"><span>Com</span>pany</a></h1> -->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="<?php echo base_url('/'); ?>" class="logo me-auto"><img src="<?= base_url(); ?>frontend/assets/img/logodisnakertransmkw.png" alt="" class="img-fluid"></a>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a <?= ($current_uris['segment_1'] == '' || ($current_uris['segment_1'] == 'home')) ? 'class="active"' : '' ?> href="<?= base_url('/'); ?>">Beranda</a></li>
                    <li><a <?= ($current_uris['segment_1'] == 'profil') ? 'class="active"' : '' ?> href="<?= base_url('profil'); ?>">Profil</a></li>

                    <li class="dropdown">
                        <a <?= in_array($current_uris['segment_1'], ['urusan_transmigrasi', 'urusan_tenaga_kerja']) ? 'class="active"' : '' ?> href="#"><span>Unit Kerja</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a <?= ($current_uris['segment_1'] == 'urusan_transmigrasi') ? 'class="active"' : '' ?> href="<?= base_url('urusan_transmigrasi'); ?>">Urusan Transmigrasi</a></li>
                            <li><a <?= ($current_uris['segment_1'] == 'urusan_tenaga_kerja') ? 'class="active"' : '' ?> href="<?= base_url('urusan_tenaga_kerja'); ?>">Urusan Tenaga Kerja</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a <?= in_array($current_uris['segment_1'], ['berita', 'pengumuman', 'pelatihan']) ? 'class="active"' : '' ?> href="#"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a <?= ($current_uris['segment_1'] == 'berita') ? 'class="active"' : '' ?> href="<?= base_url('berita'); ?>">Berita</a></li>
                            <li><a <?= ($current_uris['segment_1'] == 'pengumuman') ? 'class="active"' : '' ?> href="<?= base_url('pengumuman'); ?>">Pengumuman</a></li>
                            <li><a <?= ($current_uris['segment_1'] == 'pelatihan') ? 'class="active"' : '' ?> href="<?= base_url('pelatihan'); ?>">Pelatihan</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a <?= in_array($current_uris['segment_1'], ['kartu_ak1', 'registrasi_pencaker']) ? 'class="active"' : '' ?> href="#"><span>Layanan</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a <?= in_array($current_uris['segment_1'], ['kartu_ak1', 'registrasi_pencaker']) ? 'class="active"' : '' ?> href="<?= base_url('kartu_ak1'); ?>">Kartu Pencari Kerja (Kartu Ak/1)</a></li>
                        </ul>
                    </li>
                    <li><a <?= ($current_uris['segment_1'] == 'kontak') ? 'class="active"' : '' ?> href="<?= base_url('kontak'); ?>">Kontak</a></li>
                    <?php if (logged_in()) : ?>
                        <li><a class="btn btn-danger mx-4 p-2 text-white" href="<?= base_url('logout'); ?>">Logout</a></li>

                    <?php else : ?>
                        <li><a class="btn btn-primary mx-4 p-2 text-white" href="<?= base_url('login'); ?>">Masuk</a></li>
                    <?php endif; ?>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <div class="header-social-links d-flex">
                <a href="#" class="twitter"><i class="bu bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bu bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bu bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bu bi-linkedin"></i></i></a>
            </div>

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->


    <main id="main">
        <?= $this->renderSection('content') ?>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>DISNAKERTRANS MANOKWARI</h3>
                        <p>
                            Jl. Percetakan Negara<br>
                            Kel. Sanggeng, Kec. Manokwari Barat<br>
                            Kab. Manokwari, Prov. Papua Barat<br><br>

                            <strong>Phone:</strong> 0986-211934, 0986-211738<br>
                            <strong>Email:</strong> info@disnakertransmkw.com<br>
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Informasi</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Informasi</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Berita</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Pengumuman</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Link Terkait</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Kemnaker</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Provinsi Papua Barat</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Disnakertrans Papua Barat</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Pemkab Manokwari</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">LPSE Kemnaker</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">JDIH Kemnaker</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Lebih Dekat Dengan Kami</h4>
                        <p>Dapatkan informasi tekini dengan mengakses media sosial kami.</p>
                        <div class="social-links text-left text-md-right pt-3 pt-md-0">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>DISNAKERTRANS MANOKWARI</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/company-free-html-bootstrap-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">Arasoft Digital Creative</a>
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->

    <script src="<?= base_url(); ?>frontend/assets/vendor/aos/aos.js"></script>
    <script src="<?= base_url(); ?>frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>frontend/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url(); ?>frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url(); ?>frontend/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url(); ?>frontend/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="<?= base_url(); ?>frontend/assets/vendor/php-email-form/validate.js"></script>

    <script src="<?= base_url(); ?>frontend/sweetalert2/sweetalert2.min.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>frontend/assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox@3.1.0/dist/js/glightbox.min.js"></script>
    <script>
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    </script>
</body>

</html>