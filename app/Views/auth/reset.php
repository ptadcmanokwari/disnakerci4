<?= $this->extend('auth/template') ?>
<?= $this->section('content') ?>

<div class="card-header text-center">
    <h1 class="bold">Reset Kata Sandi</h1>
</div>
<div class="card-body">
    <?= view('Myth\Auth\Views\_message_block') ?>
    <form action="<?= route_to('reset-password') ?>" method="post">
        <?= csrf_field() ?>
        <div class="input-group mb-3">
            <input type="text" name="token" class="form-control  <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.token') ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <div class="invalid-feedback">
                <?= session('errors.token') ?>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.email') ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            <div class="invalid-feedback">
                <?= session('errors.email') ?>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.newPassword') ?>">
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
            <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.newPasswordRepeat') ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            <div class="invalid-feedback">
                <?= session('errors.pass_confirm') ?>
            </div>
        </div>

        <div class="col-12 mt-3 px-0">
            <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.resetPassword') ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>