<?= $this->extend('frontend/template') ?>
<?= $this->section('content') ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style>
    #btnRegistrasiPencaker {
        background: #116db6;
        border: 0;
        padding: 10px 24px;
        color: #fff;
        transition: 0.4s;
        border-radius: 4px;
    }

    .alert {
        padding-left: 2rem !important;
    }
</style>
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>About</h2>
            <ol>
                <li><a href="index.html">Home</a></li>
                <li>About</li>
            </ol>
        </div>

    </div>
</section>

<section id="contact" class="contact">
    <div class="container">
        <div class="section-title">
            <h2>Formulir Pembuatan Akun</h2>
            <p>Untuk pengajuan pembuatan Kartu Pencari Kerja Form AK-1 (Kartu Kuning), silakan terlebih dahulu mendaftarkan akun menggunakan NIK, Email, dan Nomor Whatsapp yang aktif.</p>
        </div>
        <div class="row border p-4 rounded py-5">

            <div class="col-lg-5 px-3 d-flex justify-content-center align-items-center ">
                <img class="w-100" src="https://i.imgur.com/uNGdWHi.png" alt="">
            </div>

            <div class="col-lg-7 px-4">
                <div class="row">
                    <?= view('Myth\Auth\Views\_message_block') ?>
                    <form action="<?= url_to('register') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="namalengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control <?php if (session('errors.namalengkap')) : ?>is-invalid<?php endif ?>" name="namalengkap" value="<?= old('namalengkap') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.namalengkap') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="nik">NIK</label>
                                    <input type="nik" class="form-control <?php if (session('errors.nik')) : ?>is-invalid<?php endif ?>" name="nik" value="<?= old('nik') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.nik') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="nohp">Nomor WhatsApp</label>
                                    <input type="text" class="form-control <?php if (session('errors.nohp')) : ?>is-invalid<?php endif ?>" name="nohp" value="<?= old('nohp') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.nohp') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" value="<?= old('username') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.username') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" value="<?= old('email') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.email') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="password">Kata Sandi</label>
                                    <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" autocomplete="off">
                                    <div class="invalid-feedback">
                                        <?= session('errors.password') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="pass_confirm">Konfirmasi Kata Sandi</label>
                                    <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" autocomplete="off">
                                </div>
                            </div>

                            <div class="g-recaptcha" data-sitekey="<?= config('MyGoogleRecaptcha')->siteKey ?>"></div>
                            <div class="form-group mt-4 mb-4">
                                <button type="submit" class="btn btn-primary">Buat Akun Sekarang</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>