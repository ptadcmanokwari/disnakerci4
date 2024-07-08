<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Berita</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Berita</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Daftar Berita</h3>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBeritaBaruModal">
                                Tambah Berita Baru
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tabelBerita" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="w-5">No.</th>
                                        <th class="w-25">Judul Berita</th>
                                        <th class="w-50">Isi Berita</th>
                                        <th class="w-10">Gambar</th>
                                        <th class="w-10">Status</th>
                                        <th class="w-5">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($berita) && is_array($berita)) : ?>
                                        <?php foreach ($berita as $key => $item) : ?>
                                            <tr>
                                                <td><?= $key + 1 ?></td>
                                                <td><?= esc($item['judul']) ?></td>
                                                <td><?= esc($item['isi']) ?></td>
                                                <td><img src="<?= base_url('uploads/berita/' . esc($item['gambar'])) ?>" alt="<?= esc($item['judul']) ?>" width="100"></td>
                                                <td><?= esc($item['status']) ?></td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm">Edit</button>
                                                    <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $item['id'] ?>">Hapus</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5">Tidak ada data ditemukan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Modal Tambah Berita -->
<div class="modal fade" id="addBeritaBaruModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addBeritaBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBeritaBaruModalLabel">Modal Tambah Berita Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form id="uploadBeritaForm" enctype="multipart/form-data"> -->
            <form id="uploadBeritaForm" enctype="multipart/form-data" method="post" action="<?= base_url('admin/simpan_berita') ?>">
                <div class="modal-body">
                    <input type="text" class="form-control" name="kategori" id="kategori" value="berita">
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

                    <input type="text" class="form-control" name="status" id="status" value="1">
                    <input type="text" class="form-control" name="users_id" id="users-id" value="1">

                    <div class="mb-3">
                        <span>Gambar</span>
                        <div id="unggahGambarBaru" class="dropzone"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btnUnggahBerita">Unggah Berita Baru</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>

<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        $('#tabelBerita').DataTable();

        // Event listener untuk tombol hapus
        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');

            // Tampilkan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus berita ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user mengonfirmasi, lakukan proses hapus via AJAX
                    $.ajax({
                        url: '<?= base_url('admin/hapus_berita') ?>',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            // Tidak perlu JSON.parse di sini, karena respons mungkin bukan JSON
                            if (response.status === 'success') {
                                row.remove();
                                Swal.fire(
                                    'Sukses!',
                                    'Berita berhasil dihapus.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus berita.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus berita.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        $('#uploadBeritaForm').submit(function(event) {
            event.preventDefault();

            var formData = new FormData($(this)[0]);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json', // Tambahkan ini untuk memastikan respons diinterpretasikan sebagai JSON
                success: function(response) {
                    if (response.status === 'success') {
                        $('#addBeritaBaruModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berita berhasil disimpan.',
                            timer: 1000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            $('#tabelBerita').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message ? response.message : 'Terjadi kesalahan saat menyimpan berita.',
                            timer: 1000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menyimpan berita.',
                        timer: 1000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }
            });
        });


        var myDropzone = new Dropzone("#unggahGambarBaru", {
            url: '<?= base_url('admin/upload_gambar') ?>',
            paramName: 'gambar',
            acceptedFiles: 'image/*',
            maxFilesize: 2, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            dictDefaultMessage: 'Seret dan lepaskan file gambar di sini atau klik untuk memilih file',
            dictRemoveFile: 'Hapus file',
            autoProcessQueue: false,
            init: function() {
                var submitButton = document.querySelector("#btnUnggahBerita");
                var myDropzone = this;

                submitButton.addEventListener("click", function() {
                    myDropzone.processQueue();
                });

                this.on("sending", function(file, xhr, formData) {
                    formData.append("kategori", $('#kategori').val());
                    formData.append("judul", $('#judul').val());
                    formData.append("isi", $('#isi').val());
                    formData.append("tags", $('#tags').val());
                    formData.append("status", $('#status').val());
                    formData.append("users_id", $('#users-id').val());
                });

                this.on("success", function(file, response) {
                    // Tidak perlu JSON.parse di sini, karena respons mungkin bukan JSON
                    if (response.status === 'success') {
                        $('#addBeritaBaruModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Gambar berhasil diunggah.',
                            timer: 1000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            $('#tabelBerita').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat mengunggah gambar.',
                            timer: 1000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    }
                });

                this.on("error", function(file, errorMessage) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: errorMessage,
                        timer: 1000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                    this.removeFile(file);
                });
            }
        });
    });
</script>


<?= $this->endSection() ?>