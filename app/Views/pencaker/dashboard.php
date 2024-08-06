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
                                    <div class="text-center">
                                        <p>Belum ada data untuk ditampilkan</p>
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
                                <button class="btn btn-primary" id="btnLapor" data-toggle="modal" data-target="#LaporModal" disabled>Lapor</button>
                            </div>
                            <div class="card-body">
                                <div id="alertContainer"></div> <!-- Container for the alert message -->
                                <div class="table-responsive">
                                    <table id="laporKerjaTable" class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">Periode</th>
                                                <th class="text-center" scope="col">Tanggal Melapor</th>
                                                <th class="text-center" scope="col">Status Pekerjaan</th>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="VerValModalLabel">Laporan Pencari Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formLaporPekerjaan">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" disabled value="<?= $id_pencaker['id']; ?>">
                    <div class="row" id="statusLapor">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-2">
                            <span>Apakah Anda telah memperoleh pekerjaan?</span>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_kerja" id="sudah" value="sudah">
                                <label class="form-check-label" for="sudah">
                                    Ya, sudah bekerja.
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status_kerja" id="belum" value="belum">
                                <label class="form-check-label" for="belum">
                                    Belum Bekerja.
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="formLapor" class="form-group mt-3 hide">
                        <div class="row">
                            <div class="alert alert-success w-100" role="alert">
                                Jika sudah bekerja, lengkapi data di bawah ini!
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group m-0">
                                    <label class="col-form-label w-100" for="nama_perusahaan">Nama Perusahaan/Instansi/Badan Hukum</label>
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group m-0">
                                    <label class="col-form-label w-100" for="bidang_perusahaan">Bidang Pekerjaan</label>
                                    <input type="text" class="form-control" id="bidang_perusahaan" name="bidang_perusahaan">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group m-0">
                                    <label class="col-form-label w-100" for="no_telp">No. Telp. Perusahaan</label>
                                    <input type="text" class="form-control" id="no_telp" name="no_telp">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group m-0">
                                    <label class="col-form-label w-100" for="jabatan">Jabatan Anda</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group m-0">
                                    <label class="col-form-label" for="alamat">Alamat Perusahaan</label>
                                    <textarea type="text" class="form-control" name="alamat" id="alamat"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" id="saveVerifikasi" class="btn btn-primary">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Perusahaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td class="w-45">Nama Perusahaan</td>
                            <td class="w-5">:</td>
                            <td class="w-50" id="detail_nama_perusahaan"></td>
                        </tr>
                        <tr>
                            <td>Bidang Perusahaan</td>
                            <td>:</td>
                            <td id="detail_bidang_perusahaan"></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td id="detail_jabatan"></td>
                        </tr>
                        <tr>
                            <td>No. Telepon Perusahaan</td>
                            <td>:</td>
                            <td id="detail_no_telp"></td>
                        </tr>
                        <tr>
                            <td>Alamat Perusahaan</td>
                            <td>:</td>
                            <td id="detail_alamat"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
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

        checkUsiaLaporan();

        $('#saveVerifikasi').on('click', function() {
            var statusKerja = $('input[name="status_kerja"]:checked').val();
            if (!statusKerja) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Silakan pilih status kerja.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            if (statusKerja === 'sudah') {
                var namaPerusahaan = $('#nama_perusahaan').val().trim();
                var bidangPerusahaan = $('#bidang_perusahaan').val().trim();
                var noTelp = $('#no_telp').val().trim();
                var jabatan = $('#jabatan').val().trim();
                var alamat = $('#alamat').val().trim();

                if (!namaPerusahaan || !bidangPerusahaan || !noTelp || !jabatan || !alamat) {
                    Swal.fire({
                        title: 'Peringatan!',
                        text: 'Harap lengkapi semua data yang diperlukan.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
            }

            var formData = $('#formLaporPekerjaan').serialize();

            $.ajax({
                url: '<?= base_url('pencaker/lapor_pencari_kerja') ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Laporan berhasil disimpan',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#formLaporPekerjaan')[0].reset(); // Reset form
                                $('#formLapor').addClass('hide'); // Hide additional form
                                $('#LaporModal').modal('hide'); // Hide modal
                                $('#laporKerjaTable').DataTable().ajax.reload(); // Reload table
                                checkUsiaLaporan(); // Re-check usia laporan
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Laporan gagal disimpan',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        title: 'Kesalahan!',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        function checkUsiaLaporan() {
            $.ajax({
                url: '<?= base_url('pencaker/check_usia_laporan') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        $('#btnLapor').prop('disabled', false);
                        $('#alertContainer').html('');
                    } else {
                        $('#btnLapor').prop('disabled', true);
                        $('#alertContainer').html('<div class="alert alert-warning" role="alert">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        title: 'Kesalahan!',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        $('#laporKerjaTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('pencaker/get_lapor_pencaker') ?>',
                type: 'GET'
            },
            columns: [{
                    data: 'urut_lapor'
                },
                {
                    data: 'tanggal_melapor'
                },
                {
                    data: 'status_pekerjaan'
                }
            ],
            searching: false,
            lengthChange: false,
            ordering: false
        });

        $('#laporKerjaTable').on('click', '.view-details', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            $.ajax({
                url: '<?= base_url('pencaker/detail_lapor_kerja') ?>/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert('Data tidak ditemukan');
                    } else {
                        $('#detail_nama_perusahaan').text(response.nama_perusahaan);
                        $('#detail_bidang_perusahaan').text(response.bidang_perusahaan);
                        $('#detail_jabatan').text(response.jabatan);
                        $('#detail_no_telp').text(response.no_telp);
                        $('#detail_alamat').text(response.alamat);

                        $('#detailModal').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });

    });
</script>

<?= $this->endSection() ?>