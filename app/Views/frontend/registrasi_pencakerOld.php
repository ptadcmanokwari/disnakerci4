<?= $this->extend('frontend/template') ?>
<?= $this->section('content') ?>
<style>
    #btnRegistrasiPencaker {
        background: #116db6;
        border: 0;
        padding: 10px 24px;
        color: #fff;
        transition: 0.4s;
        border-radius: 4px;
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

            <div class="col-md-6 px-3 d-flex justify-content-center align-items-center ">
                <img class="w-100" src="https://i.imgur.com/uNGdWHi.png" alt="">
            </div>

            <div class="col-md-6 px-4">
                <form action="<?= site_url('frontend/save_pencaker_data') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="namalengkap">Nama Lengkap</label>
                        <input type="text" name="namalengkap" id="namalengkap" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nohp">No HP</label>
                        <input type="text" name="nohp" id="nohp" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password"><?= lang('Auth.password') ?></label>
                        <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                        <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>


            </div>
        </div>

    </div>
</section>

<!-- <script>
    $(document).ready(function() {
        $('#formRegistrasi').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '/frontend/save_pencaker_data', // Sesuaikan dengan URL controller Anda
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Data berhasil disimpan.',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Gagal menyimpan data.',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script> -->

<?= $this->endSection() ?>