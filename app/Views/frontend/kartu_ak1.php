<?= $this->extend('frontend/template') ?>

<?= $this->section('content') ?>
<style>
    a.btn-buy.btn.btn-primary.text-center {
        background: #116db6;
        border: 0;
        padding: 10px 24px;
        color: #fff;
        transition: 0.4s;
        border-radius: 4px;
    }

    section#cta img.w-100 {
        height: 180px !important;
        object-fit: contain;
    }

    section#cta .services .icon-box {
        text-align: center;
        padding: 40px 20px 80px 20px;
        transition: all ease-in-out 0.3s;
        background: #fff;
    }
</style>
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
        </div>
    </div>
</section>

<section id="cta" class="cta services">
    <div class="container aos-init aos-animate" data-aos="zoom-in">

        <div class="row mb-3">
            <div class="section-title">
                <h2>Kartu Pencari Kerja (Kartu AK/1)</h2>
                <p>Kartu Ak/1 adalah kartu tanda pencari kerja yang sering disebut pula dengan kartu kuning. Kartu ini dikeluarkan oleh lembaga pemerintah, Dinas Ketenagakerjaan atau Disnaker, yang dibuat dengan tujuan untuk pendataan para pencari kerja. Yuk, hanya dengan 3 langkah berikut ini Anda dapat dengan mudah membuat Kartu Pencari Kerja (Kartu Ak/1).</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-4 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box">
                    <div class="col-md-12 py-3 d-flex justify-content-center align-items-center ">
                        <img class="w-100" src="<?= base_url(); ?>uploads/registrasi.webp" alt="Registrasi">
                    </div>
                    <h4>1. Registrasi Akun</h4>
                    <p class="text-dark">Buat akun baru dengan mengisi Nama Lengkap, NIK (Nomor Induk Kependudukan), Email, dan nomor HP/Whatsapp.</p>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 d-flex align-items-stretch mt-md-0 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-box">
                    <div class="col-md-12 py-3 d-flex justify-content-center align-items-center ">
                        <img class="w-100" src="<?= base_url(); ?>uploads/isi_form.webp" alt="Isi Form">
                    </div>
                    <h4>2. Isi Aplikasi</h4>
                    <p class="text-dark">Lengkapi form Ak/1 dan unggah dokumen kelengkapan persyaratan pencari kerja, diantaranya: Pas Foto, KTP, Ijazah Terakhir, Transkrip Nilai, Riwayat Hidup, SKCK, dan Surat Keterangan Kesehatan.</p>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 d-flex align-items-stretch mt-xl-0 aos-init aos-animate" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon-box">
                    <div class="col-md-12 py-3 d-flex justify-content-center align-items-center ">
                        <img class="w-100" src="<?= base_url(); ?>uploads/office.jpg" alt="Kantor Disnakertrans Manokwari">
                    </div>
                    <h4>3. Datang Ke Kantor</h4>
                    <p class="text-dark">Mendatangi kantor Disnakertrans Kab. Manokwari untuk mengambil Kartu Pencari Kerja (Kartu Ak/1) dengan syarat menunjukkan dokumen asli yang telah diunggah di sistem.</p>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-xl-12 col-md-12 d-flex align-items-center justify-content-center">
                <?php if (!logged_in()) : ?>
                    <a class="btn-buy btn btn-primary text-center" href="<?= url_to('register') ?>">Buat Akun Sekarang</a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection() ?>