<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Kata Sandi | Disnakertrans Manokwari</title>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>frontend/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>frontend/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>frontend/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url(); ?>frontend/assets/img/favicon/site.webmanifest">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>adminltev31/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>adminltev31/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>adminltev31/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <p class="h1"><b>Lupa Kata Sandi</b></p>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Untuk mengganti kata sandi, silakan masukkan email aktif yang terdafatar di Disnakertrans Manokwari.</p>
                <form action="<?= url_to('forgot') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control  <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Email wajib diisi!
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Minta Kata Sandi Baru</button>
                        </div>
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="<?= url_to('login') ?>">Kembali ke halaman Login</a>
                </p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url(); ?>adminltev31/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>adminltev31/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>adminltev31/dist/js/adminlte.min.js"></script>
</body>

</html>