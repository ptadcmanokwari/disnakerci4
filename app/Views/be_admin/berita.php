<?= $this->extend('be_admin/layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/fontawesome-free/css/all.min.css'); ?>">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/jqvmap/jqvmap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/dist/css/adminlte.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/daterangepicker/daterangepicker.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/summernote/summernote-bs4.min.css'); ?>">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
<style>
    table.dataTable {
        width: 100%;
        margin: 13px auto;
        border-collapse: collapse;
    }

    div#newsTable_length {
        margin-bottom: 10px;
    }
</style>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="mb-0">Berita</h3>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fixed Layout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Daftar Berita</h3>
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBeritaBaruModal">
                                    Tambah Berita Baru
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="newsTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="w-5">No.</th>
                                        <th class="w-25">Judul Berita</th>
                                        <th class="w-50">Isi Berita</th>
                                        <th class="w-10">Gambar</th>
                                        <th class="w-5">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Unggah Berita Baru-->
<div class="modal fade" id="addBeritaBaruModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addBeritaBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBeritaBaruModalLabel">Modal Tambah Berita Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="kategori" id="kategori" value="berita">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="isi" class="form-label">Isi</label>
                        <textarea class="form-control" id="isi" name="isi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tags">Tags</label>
                        <input type="text" class="form-control" name="tags" id="tags" required autofocus />
                    </div>

                    <input type="hidden" class="form-control" name="status" id="status" value="1">
                    <input type="hidden" class="form-control" name="users_id" id="users-id" value="1">

                    <div class="mb-3">
                        <span>Gambar</span>
                        <div id="unggahGambarBaru" class="dropzone"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Unggah Berita Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Berita-->
<div class="modal fade" id="addBeritaBaruModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addBeritaBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBeritaBaruModalLabel">Modal Tambah Berita Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" name="id" id="edit-id">
                    <input type="hidden" class="form-control" name="kategori" id="edit-kategori" value="berita">
                    <div class="mb-3">
                        <label for="edit-judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="edit-judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-isi" class="form-label">Isi</label>
                        <textarea class="form-control" id="edit-isi" name="isi" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit-tags">Tags</label>
                        <input type="text" class="form-control" name="tags" id="edit-tags" required autofocus />
                    </div>

                    <input type="text" class="form-control" name="status" id="edit-status" value="1">
                    <input type="hidden" class="form-control" name="users_id" id="edit-users-id" value="1">
                    <div class="mb-3">
                        <label for="edit-gambar" class="form-label">Gambar</label>
                        <div id="edit-dropzone" class="dropzone"></div>
                        <img id="edit-gambar-preview" class="img-thumbnail mt-2" width="100">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Unggah Berita Baru</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('adminltev31/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?php echo base_url('adminltev31/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/chart.js/Chart.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/sparklines/sparkline.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/dist/js/adminlte.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/dist/js/demo.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/dist/js/pages/dashboard.js'); ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Dropzone
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#unggahGambarBaru", {
            url: "<?php echo base_url('berita/uploadBerita'); ?>",
            autoProcessQueue: false,
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            dictDefaultMessage: "Seret gambar atau klik di sini untuk mengunggah",
            dictRemoveFile: "Hapus",
            init: function() {
                this.on("addedfile", function(file) {
                    // Tambahkan file gambar sebagai input tersembunyi
                    $('#unggahGambarBaru').append('<input type="hidden" name="gambar" value="' +
                        file.name + '">');
                });

                this.on("removedfile", function(file) {
                    // Hapus input tersembunyi jika file dihapus dari Dropzone
                    $('input[name="gambar"]').remove();
                });

                $('#editForm').submit(function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    } else {
                        submitForm();
                    }
                });
            },
            success: function(file, response) {
                // Tampilkan pesan sukses
                var jsonResponse = JSON.parse(response);
                if (jsonResponse.status === 'success') {
                    // Reset Dropzone setelah berhasil diunggah
                    myDropzone.removeAllFiles(true);
                    // Tampilkan pesan sukses dengan SweetAlert2
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: jsonResponse.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // Tambahkan logika redirect atau update halaman jika perlu
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: jsonResponse.message
                    });
                }
            },
            error: function(file, response) {
                // Tampilkan pesan error jika terjadi masalah
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat mengunggah gambar.'
                });
            }
        });

        function submitForm() {
            // Lakukan pengiriman form secara langsung jika tidak ada gambar yang diunggah
            $.ajax({
                url: "<?php echo base_url('berita/uploadBerita'); ?>",
                type: "POST",
                data: $('#editForm').serialize(),
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        // Tampilkan pesan sukses dengan SweetAlert2
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: jsonResponse.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Tambahkan logika redirect atau update halaman jika perlu
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: jsonResponse.message
                        });
                    }
                },
                error: function() {
                    // Tampilkan pesan error jika terjadi masalah
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mengirim data.'
                    });
                }
            });
        }
    });
</script>


<script>
    $(document).ready(function() {
        $('#isi').summernote();
    });
</script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        var table = $('#newsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('admin/berita_ajax') ?>',
                type: 'POST'
            },
            columns: [{
                    data: null
                },
                {
                    data: 'judul'
                },
                {
                    data: 'isi'
                },
                {
                    data: 'gambar',
                    render: function(data) {
                        return `<img src="<?= base_url('uploads/berita/') ?>${data}" class="img-thumbnail" width="100">`;
                    }
                },
                {
                    data: 'id',
                    render: function(data) {
                        return `
                        <button class="btn btn-warning btn-sm edit-berita" data-id="${data}">Edit</button>
                        <button class="btn btn-danger btn-sm delete-berita" data-id="${data}">Hapus</button>
                    `;
                    }
                }
            ],
            columnDefs: [{
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            }]
        });

        // Inisialisasi Dropzone
        var editDropzone;

        function initDropzone() {
            if (editDropzone) {
                editDropzone.destroy();
            }

            editDropzone = new Dropzone("#edit-dropzone", {
                url: "<?= base_url('admin/upload_gambar') ?>",
                maxFiles: 1,
                acceptedFiles: 'image/*',
                addRemoveLinks: true,
                autoProcessQueue: false, // Nonaktifkan proses otomatis
                init: function() {
                    this.on("success", function(file, response) {
                        $('#edit-gambar-preview').attr('src', response.filepath);
                        $('#edit-gambar').val(response.filename);
                    });
                }
            });
        }

        // Event handler untuk tombol Edit
        $('#newsTable').on('click', '.edit-berita', function() {
            var beritaId = $(this).data('id');

            $.ajax({
                url: '<?= base_url('admin/get_berita') ?>/' + beritaId,
                type: 'GET',
                success: function(response) {
                    $('#edit-id').val(response.id);
                    $('#edit-judul').val(response.judul);
                    $('#edit-kategori').val(response.kategori);
                    $('#edit-isi').summernote('code', response.isi);
                    $('#edit-tags').val(response.tags);
                    $('#edit-status').val(response.status);
                    $('#edit-users-id').val(response.users_id);
                    $('#edit-gambar-preview').attr('src', '<?= base_url('uploads/berita/') ?>' +
                        response.gambar);
                    $('#editModal').modal('show');

                    // Inisialisasi ulang Dropzone setelah modal muncul
                    initDropzone();
                },
                error: function() {
                    Swal.fire('Gagal!', 'Gagal memuat data berita.', 'error');
                }
            });
        });

        // Event handler untuk form Edit
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            // Mulai proses unggah Dropzone
            editDropzone.processQueue();

            $.ajax({
                url: '<?= base_url('admin/update_berita') ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#editModal').modal('hide');
                        Swal.fire('Berhasil!', 'Berita berhasil diperbarui.', 'success');
                        table.ajax.reload();
                    } else {
                        Swal.fire('Gagal!', 'Gagal memperbarui berita.', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui berita.', 'error');
                }
            });
        });

        // Event handler untuk tombol Hapus
        $('#newsTable').on('click', '.delete-berita', function() {
            var beritaId = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('admin/hapus_berita') ?>',
                        type: 'POST',
                        data: {
                            id: beritaId
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Dihapus!', 'Berita telah dihapus.',
                                    'success');
                                table.ajax.reload();
                            } else {
                                Swal.fire('Gagal!',
                                    'Terjadi kesalahan saat menghapus berita.',
                                    'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Gagal!',
                                'Terjadi kesalahan saat menghapus berita.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>