<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Disnakertrans Manokwari</title>
    <link rel="apple-touch-icon" sizes="180x180"
        href="<?= base_url(); ?>frontend/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?= base_url(); ?>frontend/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?= base_url(); ?>frontend/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url(); ?>frontend/assets/img/favicon/site.webmanifest">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url(); ?>adminltev31/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>adminltev31/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>adminltev31/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1">
                    <b>Panel Login</b>
                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan login</p>

                <form action="<?= url_to('login') ?>" method="post">

                    <div class="input-group mb-3">
                        <input type="text" name="login"
                            class="form-control  <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>"
                            placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Username harus diisi!
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password"
                            class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                            placeholder="<?= lang('Auth.password') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Kata Sandi harus diisi!
                        </div>
                    </div>
                    <div class="row">
                        <?php if ($config->allowRemembering) : ?>
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" class="form-check-input"
                                    <?php if (old('remember')) : ?> checked <?php endif ?>>
                                <label for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>

                <p class="mb-1">
                    <a href="<?= url_to('forgot') ?>">Lupa Kata Sandi?</a>
                </p>
                <p class="mb-1">
                    <a href="<?= url_to('registrasi_pencaker') ?>" class="text-center">Registrasi Pencaker</a>
                </p>
                <p class="mb-1">
                    <a href="<?= base_url(); ?>" class="text-center">Kembali ke Halaman Utama</a>
                </p>
            </div>
        </div>
    </div>

    <script src="<?= base_url(); ?>adminltev31/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>adminltev31/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>adminltev31/dist/js/adminlte.min.js"></script>
</body>

</html>