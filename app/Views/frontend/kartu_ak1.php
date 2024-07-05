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

<section id="cta" class="cta services">
    <div class="container aos-init aos-animate" data-aos="zoom-in">

        <div class="row mb-5">
            <div class="section-title">
                <h2>Kartu Pencari Kerja (Kartu AK/1)</h2>
                <p>Yuk, hanya dengan 3 langkah berikut ini Anda dapat dengan mudah membuat Kartu Pencari Kerja (Kartu Ak/1).</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-4 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box">
                    <div class="col-md-12 py-3 d-flex justify-content-center align-items-center ">
                        <img class="w-100" src="https://thumbs.dreamstime.com/b/online-registration-sign-up-concept-young-people-signing-login-to-account-user-interface-secure-password-modern-vector-194944767.jpg" alt="">
                    </div>
                    <h4>1. Registrasi Akun</h4>
                    <p class="text-dark">Buat akun baru dengan mengisi Nama Lengkap, NIK (Nomor Induk Kependudukan), Email, dan nomor HP/Whatsapp.</p>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 d-flex align-items-stretch mt-4 mt-md-0 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-box">
                    <div class="col-md-12 py-3 d-flex justify-content-center align-items-center ">
                        <img class="w-100" src="https://cdni.iconscout.com/illustration/premium/thumb/online-form-filling-4488741-3757136.png" alt="">
                    </div>
                    <h4>2. Isi Aplikasi</h4>
                    <p class="text-dark">Lengkapi form Ak/1 dan unggah dokumen kelengkapan persyaratan pencari kerja, diantaranya: Pas Foto, KTP, Ijazah Terakhir, Transkrip Nilai, Riwayat Hidup, SKCK, dan Surat Keterangan Kesehatan.</p>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 d-flex align-items-stretch mt-4 mt-xl-0 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon-box">
                    <div class="col-md-12 py-3 d-flex justify-content-center align-items-center ">
                        <img class="w-100" src="https://disnakertransmkw.com/assets/frontend/assets/img/office.jpg" alt="">
                    </div>
                    <h4>3. Datang Ke Kantor</h4>
                    <p class="text-dark">Mendatangi kantor Disnakertrans Kab. Manokwari untuk mengambil Kartu Pencari Kerja (Kartu Ak/1) dengan syarat menunjukkan dokumen asli yang telah diunggah di sistem.</p>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-xl-12 col-md-12 d-flex align-items-center justify-content-center">
                <a class="btn-buy btn btn-primary text-center" href="<?php base_url(); ?>registrasi_pencaker">Buat Akun Sekarang</a>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>