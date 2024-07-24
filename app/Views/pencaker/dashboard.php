<?= $this->extend('pencaker/template') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<meta name="csrf-token" content="<?= csrf_hash() ?>">

<style>
    a.disabled:hover {
        cursor: not-allowed !important;
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Pencari Kerja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Timeline Aktivitas Anda</h3>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <?php if (empty($timelines)) : ?>
                                    <div class="time-label">
                                        <span class="bg-gray">No Data Available</span>
                                    </div>
                                <?php else : ?>
                                    <?php foreach ($timelines as $timeline) : ?>
                                        <div class="time-label">
                                            <span class="bg-info"><?= date('d M. Y', strtotime($timeline['tglwaktu'])) ?></span>
                                        </div>
                                        <div>
                                            <i class="fas fa-envelope bg-info"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> <?= date('H:i', strtotime($timeline['tglwaktu'])) ?></span>
                                                <h3 class="timeline-header"><a href="#"><?= esc($timeline['subject']) ?></a></h3>

                                                <div class="timeline-body">
                                                    <?= esc($timeline['description']) ?>
                                                </div>
                                                <!-- <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-sm">Read more</a>
                                                    <a class="btn btn-danger btn-sm">Delete</a>
                                                </div> -->
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Status Anda</h3>
                        </div>
                        <div class="card-body">
                            <h2 class="text-bold"><?php echo $id_pencaker['keterangan_status']; ?></h2>
                            <?php if ($id_pencaker['keterangan_status'] == 'Validasi') : ?>
                                <div class="alert alert-info" role="alert">
                                    Data dan dokumen Anda sedang diverifikasi.
                                </div>
                            <?php elseif ($id_pencaker['keterangan_status'] == 'Verifikasi') : ?>
                                <div class="alert alert-info" role="alert">
                                    Silakan menunggu maksimal 3x24 jam untuk proses verifikasi. Silakan terus memantau linimasa dan juga pastikan WhatsApp selalu aktif untuk mendapatkan informasi terkait proses verifikasi bilamana didapati data dan dokumen yang diunggah tidak sesuai atau salah. Setelah diverifikasi, status ini akan berubah menjadi <strong>Validasi</strong>.
                                </div>
                            <?php else : ?>
                                <p>
                                    <?php if ($isDataComplete && $isDocumentComplete) : ?>
                                <div class="alert alert-success" role="alert">
                                    Data Anda sudah lengkap. Silakan ajukan verifikasi data di bawah ini.
                                </div>
                            <?php else : ?>
                                <div class="alert alert-warning" role="alert">
                                    Data Anda belum lengkap. Silakan cek Formulir AK/1 pada menu Profil Pencaker dan mengunggah dokumen pada menu Dokumen Pencaker.
                                </div>
                            <?php endif; ?>
                            </p>
                            <?php if ($id_pencaker['keterangan_status'] != 'Validasi') : ?>
                                <form id="verificationForm">
                                    <input type="text" class="form-control" name="id_pencaker" id="id_pencaker" readonly value="<?= $id_pencaker['id']; ?>">
                                    <input type="hidden" id="mintaVerifikasi" name="mintaverifikasi" value="Verifikasi">
                                    <button id="verifyLink" class="btn btn-primary <?= $isDataComplete && $isDocumentComplete ? '' : 'btn btn-secondary disabled' ?>" title="Verifikasi Data">Minta Verifikasi Data</button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#verifyLink').on('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: 'Pastikan semua data yang Anda input sudah benar dan dokumen-dokumen yang diunggah dapat dibaca dengan baik (tidak kabur).',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya Yakin!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id_pencaker = $('#id_pencaker').val();
                    var formData = {
                        id_pencaker: id_pencaker,
                        keterangan_status: $('#mintaVerifikasi').val(),
                    };

                    $.ajax({
                        url: '<?= site_url("pencaker/minta_verifikasi") ?>',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.status == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: response.message,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Eror!',
                                    text: response.message,
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Eror!',
                                text: 'Gagal melakukan verifikasi data!',
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>