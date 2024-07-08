<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">

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
                                        <th>No.</th>
                                        <th>Judul Berita</th>
                                        <th>Isi Berita</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
    </section>
</div>


<!-- Modal Tambah Berita -->
<div class="modal fade" id="addBeritaBaruModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addBeritaBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBeritaBaruModalLabel">Modal Tambah Berita Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadBeritaForm" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="kategori" id="kategori" value="berita">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Berita</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <span>Isi Berita</span>
                        <textarea id="isi" name="isi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tags">Tags Berita</label>
                        <input type="text" class="form-control" name="tags" id="tags" required autofocus />
                    </div>

                    <input type="hidden" class="form-control" name="status" id="status" value="1">
                    <input type="hidden" class="form-control" name="users_id" id="users-id" value="1">

                    <div class="mb-3">
                        <span>Gambar Berita</span>
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
<div class="modal fade" id="ubahBeritaBaruModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahBeritaBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahBeritaBaruModalLabel">Modal Sunting Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <input type="text" name="edit_id" id="edit_id">
                    <input type="hidden" class="form-control" name="edit_kategori" id="edit_kategori" value="">
                    <div class="mb-3">
                        <label for="edit_judul" class="form-label">Ubah Judul Berita</label>
                        <input type="text" class="form-control" id="edit_judul" name="edit_judul">
                    </div>
                    <div class="mb-3">
                        <label for="edit_isi" class="form-label">Ubah Isi Berita</label>
                        <textarea class="form-control" id="edit_isi" name="edit_isi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tags">Ubah Tags Berita</label>
                        <input type="text" class="form-control" name="edit_tags" id="edit_tags">
                    </div>

                    <input type="hidden" class="form-control" name="edit_status" id="edit_status" value="1">
                    <input type="hidden" class="form-control" name="edit_users-id" id="edit_users-id" value="1">
                    <div class="mb-3">
                        <span>Gambar</span>
                        <div id="edit_dropzone" class="dropzone"></div>
                        <img id="edit_gambar-preview" class="img-thumbnail mt-2" width="100">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Perbarui Berita</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

<script>
    $(function() {
        $('#isi').summernote()
    })
</script>

<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        var tableBerita = $('#tabelBerita').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                "url": "<?php echo base_url('admin/beritaajax'); ?>", // Sesuaikan dengan route yang benar di CodeIgniter
                "type": "POST"
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "judul"
                },
                {
                    "data": "isi"
                },
                {
                    "data": "gambar"
                },
                {
                    "data": "status"
                },
                {
                    "data": "aksi"
                }
            ],
            "drawCallback": function(settings) {
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                elems.forEach(function(html) {
                    if (!html.switchery) {
                        var switchery = new Switchery(html, {
                            size: 'small'
                        });
                        html.switchery = switchery; // attach switchery instance to html element
                    }

                    html.onchange = function() {
                        var status = this.checked ? 1 : 0;
                        var id = this.getAttribute('data-id');

                        // Kirim AJAX request untuk memperbarui status di server
                        fetch('<?= base_url('admin/update_status_berita') ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                                },
                                body: JSON.stringify({
                                    id: id,
                                    status: status
                                })
                            }).then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: 'Status berhasil diperbarui.',
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: 'Gagal memperbarui status.',
                                    });
                                }
                            }).catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan saat memperbarui status.',
                                });
                            });
                    };
                });
            }
        });




        // Event listener untuk tombol hapus
        $('#tabelBerita').on('click', '.btn-delete', function() {
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
                                tableBerita.ajax.reload(); // Reload tabel setelah hapus
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

        function resetAddModal() {
            var judul = document.getElementById('judul');
            var isi = document.getElementById('isi');
            var tags = document.getElementById('tags');

            if (judul) {
                judul.value = '';
            }
            if (isi) {
                isi.value = '';
            }
            if (tags) {
                tags.value = '';
            }
            if (addDropzone) {
                addDropzone.removeAllFiles();
            }
        }

        const addDropzone = new Dropzone("#unggahGambarBaru", {
            url: "<?= base_url('admin/save_berita') ?>",
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            dictDefaultMessage: "Seret gambar ke sini untuk unggah",
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            init: function() {
                var addDropzone = this;
                document.querySelector("#uploadBeritaForm").addEventListener("submit", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (addDropzone.getQueuedFiles().length > 0) {
                        addDropzone.processQueue();
                    } else {
                        Swal.fire('Error', 'Gambar produk belum diunggah.', 'error');
                    }
                });
                this.on("sending", function(file, xhr, formData) {
                    formData.append("kategori", document.querySelector("#kategori").value);
                    formData.append("judul", document.querySelector("#judul").value);
                    formData.append("isi", document.querySelector("#isi").value);
                    formData.append("tags", document.querySelector("#tags").value);
                    formData.append("status", document.querySelector("#status").value);
                    formData.append("users_id", document.querySelector("#users-id").value);
                });
                this.on("success", function(file, response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berita baru telah diunggah.',
                        }).then((result) => {
                            $('#addBeritaBaruModal').modal('hide');
                            resetAddModal();
                            $('#tabelBerita').DataTable().ajax.reload();
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal unggah berita baru.',
                        });
                    }
                });
                this.on("error", function(file, response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal unggah berita baru.',
                    });
                });
            }
        });

        $('.btn-edit').on('click', function() {
            var edit_id = $(this).data('edit_id');
            var edit_judul = $(this).data('edit_judul');
            var edit_isi = $(this).data('edit_isi');
            var edit_tags = $(this).data('edit_tags');
            // var gambar = $(this).data('edit_gambar');

            // Set data ke dalam modal
            $('#edit_id').val(edit_id);
            $('#edit_judul').val(edit_judul);
            $('#edit_isi').val(edit_isi);
            $('#edit_tags').val(edit_tags);
            // $('#edit-gambar-preview').attr('src', 'uploads/berita/' + gambar);

            // Tampilkan modal
            $('#ubahBeritaBaruModal').modal('show');
        });

        const editDropzone = new Dropzone("#edit-dropzone", {
            url: "<?= base_url('admin/update_berita') ?>",
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            dictDefaultMessage: "Seret gambar ke sini untuk unggah",
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            init: function() {
                var editDropzone = this;
                document.querySelector("#editForm").addEventListener("submit", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (editDropzone.getQueuedFiles().length > 0) {
                        editDropzone.processQueue();
                    } else {
                        // Proses form tanpa unggah gambar baru
                        updateBeritaWithoutImage();
                    }
                });
                this.on("sending", function(file, xhr, formData) {
                    formData.append("id", document.querySelector("#edit-id").value);
                    formData.append("kategori", document.querySelector("#edit-kategori").value);
                    formData.append("judul", document.querySelector("#edit-judul").value);
                    formData.append("isi", document.querySelector("#edit-isi").value);
                    formData.append("tags", document.querySelector("#edit-tags").value);
                    formData.append("status", document.querySelector("#edit-status").value);
                    formData.append("users_id", document.querySelector("#edit-users-id").value);
                });
                this.on("success", function(file, response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berita telah diperbarui.',
                        }).then((result) => {
                            $('#ubahBeritaBaruModal').modal('hide');
                            resetEditModal();
                            $('#tabelBerita').DataTable().ajax.reload();
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal memperbarui berita.',
                        });
                    }
                });
                this.on("error", function(file, response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memperbarui berita.',
                    });
                });
            }
        });

        function updateBeritaWithoutImage() {
            $.ajax({
                url: "<?= base_url('admin/update_berita_without_image') ?>",
                method: "POST",
                data: $('#editForm').serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berita telah diperbarui.',
                        }).then((result) => {
                            $('#ubahBeritaBaruModal').modal('hide');
                            resetEditModal();
                            $('#tabelBerita').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal memperbarui berita.',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memperbarui berita.',
                    });
                }
            });
        }

        function resetEditModal() {
            document.querySelector("#editForm").reset();
            editDropzone.removeAllFiles();
            $('#edit-gambar-preview').attr('src', '');
        }
    });
</script>



<?= $this->endSection() ?>