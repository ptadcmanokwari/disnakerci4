<?= $this->extend('auth/template') ?>
<?= $this->section('content') ?>
<div class="card-header text-center">
    <h1>Registrasi</h1>
</div>
<div class="card-body">
    <p class="login-box-msg">Registasi Pencari Kerja</p>
    <?= view('Myth\Auth\Views\_message_block') ?>
    <form action="<?= url_to('register') ?>" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control <?php if (session('errors.namalengkap')) : ?>is-invalid<?php endif ?>" name="namalengkap" placeholder="Nama Lengkap" value="<?= old('namalengkap') ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <div class="invalid-feedback">
                Nama Lengkap harus diisi!
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="nik" class="form-control <?php if (session('errors.nik')) : ?>is-invalid<?php endif ?>" name="nik" placeholder="NIK" value="<?= old('nik') ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <div class="invalid-feedback">
                NIK harus diisi!
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="nohp" class="form-control <?php if (session('errors.nohp')) : ?>is-invalid<?php endif ?>" name="nohp" placeholder="No. WhatsApp" value="<?= old('nohp') ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <div class="invalid-feedback">
                Nomor HP harus diisi!
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="Email" value="<?= old('email') ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <div class="invalid-feedback">
                Email harus diisi!
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Username" value="<?= old('username') ?>">
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
            <input type="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" name="password" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            <div class="invalid-feedback">
                <?= session('errors.password') ?>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control  <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" name="pass_confirm" placeholder="Retype password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                        I agree to the <a href="#">terms</a>
                    </label>
                </div>
            </div> -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </div>
    </form>

    <!-- <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i>
            Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i>
            Sign up using Google+
        </a>
    </div> -->

    <a href="<?= url_to('login') ?>" class="text-center">Kembali ke Halaman Login</a>
</div>

<?= $this->endSection() ?>