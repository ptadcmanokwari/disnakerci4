<?= $this->extend('auth/template') ?>
<?= $this->section('content') ?>

<div class="card-header text-center">
    <h1 class="bold">Lupa Kata Sandi?</h1>
</div>
<div class="card-body">
    <p class="login-box-msg">Tidak masalah! Masukkan email Anda di bawah ini dan kami akan mengirimkan instruksi untuk mengatur ulang kata sandi Anda.</p>
    <?= view('Myth\Auth\Views\_message_block') ?>
    <form action="<?= route_to('forgot') ?>" method="post">
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control  <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="Email Terdaftar">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <div class="invalid-feedback">
                <?= session('errors.email') ?>
            </div>
        </div>

        <div class="col-12 mt-3 px-0">
            <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.sendInstructions') ?></button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>