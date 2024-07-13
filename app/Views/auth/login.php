<?= $this->extend('auth/template') ?>
<?= $this->section('content') ?>

<div class="card-header text-center">
  <h1 class="bold">Panel Login</h1>
</div>
<div class="card-body">
  <p class="login-box-msg">Silahkan login</p>
  <?= view('Myth\Auth\Views\_message_block') ?>
  <form action="<?= url_to('login') ?>" method="post">

    <div class="input-group mb-3">
      <input type="text" name="login" class="form-control  <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="Username">
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
      <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
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
            <input type="checkbox" id="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
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

  <!-- <div class="social-auth-links text-center mt-2 mb-3">
    <a href="#" class="btn btn-block btn-danger">
      <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
    </a>
  </div> -->

  <p class="mb-1">
    <a href="<?= url_to('forgot') ?>">Lupa Kata Sandi?</a>
  </p>
  <p class="mb-1">
    <a href="<?= url_to('register') ?>" class="text-center">Registrasi Pencaker</a>
  </p>
  <p class="mb-1">
    <a href="<?= base_url(); ?>" class="text-center">Kembali ke Halaman Utama</a>
  </p>
</div>

<?= $this->endSection() ?>