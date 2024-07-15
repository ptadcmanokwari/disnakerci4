<?= $this->extend('auth/template') ?>
<?= $this->section('content') ?>

<div class="card-header text-center">
  <h1 class="bold">Panel Login</h1>
</div>
<div class="card-body">
  <!-- <p class="login-box-msg">Masuk dengan Nama Pengguna dan Kata Sandi!</p> -->
  <?= view('Myth\Auth\Views\_message_block') ?>
  <form action="<?= url_to('login') ?>" method="post">
    <div class="input-group mb-3">
      <input type="text" name="login" class="form-control  <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="Nama Pengguna">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
      <div class="invalid-feedback">
        Nama Pengguna harus diisi!
      </div>
    </div>
    <div class="input-group mb-3">
      <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="Kata Sandi">
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
        <div class="col-6">
          <div class="icheck-primary">
            <input type="checkbox" id="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
            <label for="remember">
              Ingat Saya
            </label>
          </div>
        </div>
      <?php endif; ?>
      <div class="col-6 d-flex align-items-center justify-content-end">
        <a href="<?= url_to('forgot') ?>">Lupa Kata Sandi?</a>
      </div>
    </div>
    <div class="col-12 mt-3 px-0">
      <button type="submit" class="btn btn-primary btn-block">Masuk</button>
    </div>
  </form>
  <p class="mb-1 text-small my-3 text-center">
    Belum punya akun? <a href="<?= url_to('register') ?>" class="text-center">Registrasi</a>
  </p>
</div>
</div>
<p class="mb-1 text-center mt-3">
  <a href="<?= base_url(); ?>" class="text-center">Kembali ke Halaman Utama</a>
</p>
<?= $this->endSection() ?>