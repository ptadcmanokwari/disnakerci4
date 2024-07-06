<?= $this->extend('frontend/template') ?>
<?= $this->section('content') ?>

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

                        <script src="https://www.google.com/recaptcha/api.js" async="" defer=""></script>

                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6Le7UeAgAAAAALuSu9qTlF-m5kTHe8oQx-_gHsVf">
                                <div style="width: 304px; height: 78px;">
                                    <div><iframe title="reCAPTCHA" width="304" height="78" role="presentation" name="a-zaqbt0wepbda" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6Le7UeAgAAAAALuSu9qTlF-m5kTHe8oQx-_gHsVf&amp;co=aHR0cHM6Ly9kaXNuYWtlcnRyYW5zbWt3LmNvbTo0NDM.&amp;hl=en&amp;v=rKbTvxTxwcw5VqzrtN-ICwWt&amp;size=normal&amp;cb=t8t1kt403869"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                </div><iframe style="display: none;"></iframe>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex mt-4">
                        <button type="submit" id="btnRegistrasiPencaker" class="btn btn-primary w-50">Daftar</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>

<div class="row mt-5 justify-content-center" data-aos="fade-up">
    <div class="col-lg-10">
        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama Lengkap" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Judul Pesan" required>
            </div>
            <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Isi Pesan" required></textarea>
            </div>
            <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Pesan Anda telah dikirim!</div>
            </div>
            <div class="text-center"><button type="submit">Kirim Pesan</button></div>
        </form>
    </div>

</div>