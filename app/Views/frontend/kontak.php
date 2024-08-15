<?= $this->extend('frontend/template') ?>

<?= $this->section('content') ?>
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
        </div>
    </div>
</section>

<div class="map-section">
    <iframe style="border:0; width: 100%; height: 350px;" src="<?= $settings['maps']; ?>" frameborder="0" allowfullscreen></iframe>
</div>

<section id="contact" class="contact">
    <div class="container">

        <div class="row justify-content-center mb-4" data-aos="fade-up">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 info">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Lokasi:</h4>
                        <p><?= $settings['company_address']; ?></p>
                    </div>

                    <div class="col-lg-4 info mt-4 mt-lg-0">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p><?= $settings['company_email']; ?></p>
                    </div>

                    <div class="col-lg-4 info mt-4 mt-lg-0">
                        <i class="bi bi-phone"></i>
                        <h4>Telepon:</h4>
                        <p><?= $settings['company_phone1']; ?>, <?= $settings['company_phone2']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="row mt-4" data-aos="fade-left">
            <div class="col-lg-5 d-flex flex-column justify-content-center">
                <div class="section-title text-left">
                    <h3><strong class="text-info">Punya pertanyaan lebih lanjut?</strong></h3>
                    <p class="text-secondary mt-3">Hubungi kami dengan melengkapi form di bawah ini. Pertanyaan, masukan, dan saran Anda akan kami belas melalui email.</p>
                </div>
            </div>
            <div class="col-lg-7">
                <form id="contactform" method="post">
                    <div class="col-md-12 mt-3">
                        <div class="form-group mt-4">
                            <label for="name" class="control-label">Nama Lengkap</label>
                            <input class="form-control" name="name" type="text">
                            <span class="text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <label for="email" class="control-label">Email Anda</label>
                            <input class="form-control" name="email" type="email" required>
                            <span class="text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <label for="subject" class="control-label">Judul</label>
                            <input class="form-control" name="subject" type="text">
                            <span class="text-danger"></span>
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <label for="message" class="control-label">Isi</label>
                            <textarea class="form-control" name="message" rows="4"></textarea>
                            <span class="text-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 mt-3">
                            <button id="submitBtn" type="submit" class="btn btn-info text-light w-25">
                                <span id="btnText">Kirim Data</span>
                                <span id="btnLoading" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#contactform').on('submit', function(e) {
            e.preventDefault();

            // Tampilkan icon loading dan ubah teks tombol
            $('#btnText').addClass('d-none');
            $('#btnLoading').removeClass('d-none');
            $('#submitBtn').attr('disabled', true);

            $.ajax({
                url: "<?= base_url('kontak_kami') ?>",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    // Bersihkan pesan kesalahan sebelumnya
                    $('.text-danger').text('');

                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                            timer: 1000,
                            showConfirmButton: false
                        });
                        // Reset form setelah berhasil
                        $('#contactform')[0].reset();
                    } else if (response.errors) {
                        // Tangani kesalahan validasi
                        if (response.errors.email) {
                            $('input[name="email"]').next('.text-danger').text(response.errors.email);
                        }
                        if (response.errors.name) {
                            $('input[name="name"]').next('.text-danger').text(response.errors.name);
                        }
                        if (response.errors.subject) {
                            $('input[name="subject"]').next('.text-danger').text(response.errors.subject);
                        }
                        if (response.errors.message) {
                            $('textarea[name="message"]').next('.text-danger').text(response.errors.message);
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Silakan perbaiki kesalahan di form.',
                            timer: 1000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message,
                            timer: 1000,
                            showConfirmButton: false
                        });
                    }

                    // Kembalikan tombol ke keadaan semula
                    $('#btnText').removeClass('d-none');
                    $('#btnLoading').addClass('d-none');
                    $('#submitBtn').attr('disabled', false);
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan, silakan coba lagi.',
                        timer: 1000,
                        showConfirmButton: false
                    });

                    // Kembalikan tombol ke keadaan semula
                    $('#btnText').removeClass('d-none');
                    $('#btnLoading').addClass('d-none');
                    $('#submitBtn').attr('disabled', false);
                }
            });
        });
    });
</script>


<?= $this->endSection() ?>