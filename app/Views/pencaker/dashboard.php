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
                                        </div>
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

                                                <div class="row p-3">
                                                    <div class="col-lg-11">
                                                        <div class="timeline-body">
                                                            <?= esc($timeline['description']) ?>
                                                            <?php if ($id_pencaker['keterangan_status'] == 'Re-Verifikasi' && $timeline['timeline_id'] == 4) : ?>
                                                                <div class="alert alert-danger mt-3">
                                                                    <?php echo $verifikasiData['pesan']; ?>
                                                                </div>
                                                            <?php endif; ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1 d-flex justify-content-center align-items-center">
                                                        <div class="timeline-footer">
                                                            <i class="bi bi-check-lg text-success"></i>
                                                        </div>
                                                    </div>
                                                </div>

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
                            <h2 class="text-bold <?php if ($id_pencaker['keterangan_status'] == 'Re-Verifikasi') : ?> text-danger  <?php elseif ($id_pencaker['keterangan_status'] == 'Verifikasi') : ?><?php endif; ?>"><?php echo $id_pencaker['keterangan_status']; ?></h2>
                            <?php if ($id_pencaker['keterangan_status'] == 'Validasi') : ?>
                                <div class="alert alert-warning" role="alert">
                                    Silahkan datang ke kantor Disnakertrans Kab. Manokwari untuk mengambil Kartu Pencari Kerja (Kartu Kuning) dengan menunjukkan dokumen asli yang sebelumnya telah anda unggah di sistem disnakertransmkw.com
                                </div>
                            <?php elseif ($id_pencaker['keterangan_status'] == 'Verifikasi') : ?>
                                <div class="alert alert-warning" role="alert">
                                    Silakan menunggu maksimal 3x24 jam untuk proses verifikasi. Silakan terus memantau linimasa dan juga pastikan WhatsApp selalu aktif untuk mendapatkan informasi terkait proses verifikasi bilamana didapati data dan dokumen yang diunggah tidak sesuai atau salah. Setelah diverifikasi, status ini akan berubah menjadi <strong>Validasi</strong>.
                                </div>
                            <?php elseif ($id_pencaker['keterangan_status'] == 'Aktif') : ?>
                                <div class="alert alert-warning" role="alert">
                                    Anda telah resmi terdaftar sebagai Pencari Kerja (Aktif) di Disnakertrans Manokwari. Kami mohon untuk kembali melapor setiap 6 (enam) bulan sekali melalui panel Pencaker pada website disnakertransmkw.com.
                                </div>
                            <?php endif; ?>

                            <?php if ($id_pencaker['keterangan_status'] == 'Registrasi') : ?>
                                <form id="verificationForm">
                                    <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" readonly value="<?= $id_pencaker['id']; ?>">
                                    <input type="hidden" id="mintaVerifikasi" name="mintaverifikasi" value="Verifikasi">
                                    <?php if ($isDataComplete && $isDocumentComplete) : ?>
                                        <div class="alert alert-success" role="alert">
                                            Data Anda sudah lengkap. Silakan ajukan verifikasi data di bawah ini.
                                        </div>
                                    <?php endif; ?>
                                    <button id="verifyLink" class="btn btn-primary <?= $isDataComplete && $isDocumentComplete ? '' : 'btn btn-secondary disabled' ?>" title="Verifikasi Data">Minta Verifikasi Data</button>
                                </form>
                            <?php elseif ($id_pencaker['keterangan_status'] == 'Re-Verifikasi') : ?>
                                <form id="verificationForm">
                                    <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" readonly value="<?= $id_pencaker['id']; ?>">
                                    <input type="hidden" id="mintaVerifikasi" name="mintaverifikasi" value="Verifikasi">
                                    <div class="alert alert-danger" role="alert">
                                        Data Anda ada yang perlu diperbaiki. Silakan cek kembali sesuai dengan pesan eror pada timeline.
                                    </div>
                                    <button id="reverifyLink" class="btn btn-primary <?= $isDataComplete && $isDocumentComplete ? '' : 'btn btn-secondary disabled' ?>" title="Verifikasi Data">Minta Verifikasi Ulang Data</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($id_pencaker['keterangan_status'] == 'Aktif') : ?>
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Laporan Pencari Kerja</h3>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#LaporModal">Lapor</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Periode Laporan</th>
                                                <th scope="col">Tanggal Melapor</th>
                                                <th scope="col">Status Pekerjaan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>


        </div>
    </section>
</div>


<div class="modal fade" id="LaporModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="LaporModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="VerValModalLabel">Laporan Pencari Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" disabled value="<?= $id_pencaker['id']; ?>">
                    <div class="row" id="statusLapor">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <span>Apakah Anda telah memperoleh pekerjaan?</span>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_pekerjaan" id="sudah" value="sudah">
                                <label class="form-check-label" for="sudah">
                                    Ya, sudah bekerja.
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_pekerjaan" id="belum" value="belum">
                                <label class="form-check-label" for="belum">
                                    Belum Bekerja.
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="formLapor" class="form-group mt-3 hide">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group m-0">
                                    <label class="col-form-label w-100" for="nama_perushaaan">Nama Perusahaan/Instansi/Badan Hukum</label>
                                    <input type="text" class="form-control" id="nama_perushaaan" name="nama_perushaaan">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group m-0">
                                    <label class="col-form-label w-100" for="bidang_pekerjaan">Bidang Pekerjaan</label>
                                    <input type="text" class="form-control" id="bidang_pekerjaan" name="bidang_pekerjaan">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group m-0">
                                    <label class="col-form-label w-100" for="nohp_perusahaan">No. Telp. Perusahaan</label>
                                    <input type="text" class="form-control" id="nohp_perusahaan" name="nohp_perusahaan">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group m-0">
                                    <label class="col-form-label w-100" for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group m-0">
                                    <label class="col-form-label" for="alamat_perusahaan">Alamat</label>
                                    <textarea type="text" class="form-control form-control-sm" name="alamat_perusahaan" id="alamat_perusahaan"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" id="saveVerifikasi" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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

        $('#reverifyLink').on('click', function(event) {
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

        $('#statusLapor input[type="radio"]').change(function() {
            if ($('#sudah').is(':checked')) {
                $('#formLapor').removeClass('hide').show();
            } else {
                $('#formLapor').addClass('hide').hide();
            }
        });
    });
</script>

<?= $this->endSection() ?>