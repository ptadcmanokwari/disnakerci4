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
                <form action="#" method="POST" id="formRegistrasi" novalidate="novalidate">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="namalengkap" class="form-label">Nama Lengkap </label>
                            <input type="text" class="form-control" id="namalengkap" required="" name="namalengkap">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="number" class="form-control" id="nik" required="" name="nik">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required="" name="email">
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="nohp" class="form-label">Nomor HP (WhatsApp)</label>
                            <input type="number" class="form-control" id="nohp" required="" name="nohp">
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <div class="input-group" id="katasandi">
                                <input class="form-control" id="password" type="password" required="" name="password">
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="password_confirm" class="form-label">Konfirmasi Kata Sandi </label>
                            <div class="input-group" id="katasandi_konfir">
                                <input type="password" class="form-control" id="password_confirm" required="" name="password_confirm">

                            </div>
                            <span id="error-password_confirm" class="errormsg"></span>
                        </div>

                        <!-- <script src="https://www.google.com/recaptcha/api.js" async="" defer=""></script> -->

                        <!-- <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6Le7UeAgAAAAALuSu9qTlF-m5kTHe8oQx-_gHsVf">
                                <div style="width: 304px; height: 78px;">
                                    <div><iframe title="reCAPTCHA" width="304" height="78" role="presentation" name="a-zaqbt0wepbda" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6Le7UeAgAAAAALuSu9qTlF-m5kTHe8oQx-_gHsVf&amp;co=aHR0cHM6Ly9kaXNuYWtlcnRyYW5zbWt3LmNvbTo0NDM.&amp;hl=en&amp;v=rKbTvxTxwcw5VqzrtN-ICwWt&amp;size=normal&amp;cb=t8t1kt403869"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                </div><iframe style="display: none;"></iframe>
                            </div>
                        </div> -->

                    </div>
                    <div class="d-flex mt-4">
                        <button type="submit" id="btnRegistrasiPencaker" class="btn btn-primary w-50">Buat Akun</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</section>

<script>
    $(document).ready(function() {
        $('#formRegistrasi').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'frontend/save_pencaker_data', // sesuaikan dengan URL controller Anda
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        // Tampilkan SweetAlert untuk memberitahu bahwa data berhasil disimpan
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: 'Data berhasil disimpan.',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            // Redirect ke halaman baru atau reload halaman
                            location.reload(); // Untuk reload halaman saat ini
                            // Atau bisa juga redirect ke halaman lain
                            // window.location.href = 'halaman_sukses';
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
</script>



<?= $this->endSection() ?>