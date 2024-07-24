<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pelatihan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pelatihan</li>
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
                            <h3 class="card-title">Tabel Daftar Pelatihan</h3>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPelatihanBaruModal">
                                Tambah Pelatihan Baru
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tabelPelatihan" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Judul Pelatihan</th>
                                        <th>Isi Pelatihan</th>
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


<!-- Modal Tambah Pelatihan -->
<div class="modal fade" id="addPelatihanBaruModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addPelatihanBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPelatihanBaruModalLabel">Modal Tambah Pelatihan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadPelatihanForm" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="kategori" id="kategori" value="pelatihan">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Pelatihan</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <span>Isi Pelatihan</span>
                        <textarea id="isi" name="isi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tags">Tags Pelatihan</label>
                        <input type="text" class="form-control" name="tags" id="tags" required>
                    </div>

                    <input type="hidden" class="form-control" name="status" id="status" value="1">
                    <input type="hidden" class="form-control" name="users_id" id="users-id" value="1">

                    <div class="mb-3">
                        <span>Gambar Pelatihan</span>
                        <div id="unggahGambarBaru" class="dropzone"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btnUnggahPelatihan">Unggah Pelatihan Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Pelatihan-->
<div class="modal fade" id="ubahPelatihanModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahPelatihanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahPelatihanModalLabel">Modal Sunting Pelatihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editPelatihanForm" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <input type="hidden" class="form-control" name="edit_kategori" id="edit_kategori" value="pelatihan">
                    <div class="mb-3">
                        <label for="edit_judul" class="form-label">Ubah Judul Pelatihan</label>
                        <input type="text" class="form-control" id="edit_judul" name="edit_judul">
                    </div>
                    <div class="mb-3">
                        <span>Ubah Isi Pelatihan</span>
                        <textarea id="edit_isi" name="edit_isi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tags">Ubah Tags Pelatihan</label>
                        <input type="text" class="form-control" name="edit_tags" id="edit_tags">
                    </div>

                    <input type="hidden" class="form-control" name="edit_status" id="edit_status" value="1">
                    <input type="hidden" class="form-control" name="edit_users-id" id="edit_users-id" value="1">

                    <div class="mb-3">
                        <span>Ubah Gambar</span>
                        <div id="edit_gambar_dropzone" class="dropzone"></div>
                        <img id="edit-gambar-preview" class="img-thumbnail mt-2" width="100">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Perbarui Pelatihan</button>
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
        $('#isi').summernote();
        $('#edit_isi').summernote();
    })
</script>

<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        var tabelPelatihan = $('#tabelPelatihan').DataTable({
            "processing": true,
            "serverSide": false,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                "url": "<?php echo base_url('admin_v2/pelatihanajax'); ?>", // Sesuaikan dengan route yang benar di CodeIgniter
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
                        fetch('<?= base_url('admin_v2/update_status_pelatihan') ?>', {
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
        $('#tabelPelatihan').on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            var judul = $(this).data('judul');
            var row = $(this).closest('tr');

            // Tampilkan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus pelatihan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user mengonfirmasi, lakukan proses hapus via AJAX
                    $.ajax({
                        url: '<?= base_url('admin_v2/hapus_pelatihan') ?>',
                        type: 'POST',
                        data: {
                            id: id,
                            judul: judul
                        },
                        success: function(response) {
                            // Tidak perlu JSON.parse di sini, karena respons sudah berupa JSON
                            if (response.status === 'success') {
                                tabelPelatihan.ajax.reload(); // Reload tabel setelah hapus
                                Swal.fire(
                                    'Sukses!',
                                    'Pelatihan berhasil dihapus.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus pelatihan.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus pelatihan.',
                                'error'
                            );
                        }
                    });
                }
            });
        });


        // Reset Modal setelah upload dan update data
        function resetModal() {
            var judul = document.getElementById('judul');
            var edit_judul = document.getElementById('edit_judul');
            var isi = $('#isi');
            var edit_isi = $('#edit_isi');
            var tags = document.getElementById('tags');
            var edit_tags = document.getElementById('edit_tags');

            if (judul) {
                judul.value = '';
            }
            if (edit_judul) {
                edit_judul.value = '';
            }
            if (isi) {
                isi.summernote('code', '');
            }
            if (edit_isi) {
                edit_isi.summernote('code', '');
            }
            if (tags) {
                tags.value = '';
            }
            if (edit_tags) {
                edit_tags.value = '';
            }
            if (addDropzone) {
                addDropzone.removeAllFiles();
            }
            if (editDropzone) {
                editDropzone.removeAllFiles();
            }

            $('#edit-gambar-preview').attr('src', '');
        }


        const addDropzone = new Dropzone("#unggahGambarBaru", {
            url: "<?= base_url('admin_v2/save_pelatihan') ?>",
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            dictDefaultMessage: "Seret gambar ke sini untuk unggah",
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            init: function() {
                var addDropzone = this;
                document.querySelector("#uploadPelatihanForm").addEventListener("submit", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (addDropzone.getQueuedFiles().length > 0) {
                        addDropzone.processQueue();
                    } else {
                        Swal.fire('Error', 'Gambar pelatihan belum diunggah.', 'error');
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
                            text: 'Pelatihan baru telah diunggah.',
                        }).then((result) => {
                            $('#addPelatihanBaruModal').modal('hide');
                            resetModal();
                            $('#tabelPelatihan').DataTable().ajax.reload();
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal unggah pelatihan baru.',
                        });
                    }
                });
                this.on("error", function(file, response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal unggah pelatihan baru.',
                    });
                });
            }
        });

        $(document).on('click', '.btn-edit', function() {
            var edit_id = $(this).data('edit_id');
            var edit_judul = $(this).data('edit_judul');
            var edit_isi = $(this).data('edit_isi');
            var edit_tags = $(this).data('edit_tags');
            var edit_gambar = $(this).data('edit_gambar');

            // Set data ke dalam modal
            $('#edit_id').val(edit_id);
            $('#edit_judul').val(edit_judul);
            $('#edit_isi').summernote('code', edit_isi);
            $('#edit_tags').val(edit_tags);

            if (edit_gambar) {
                $('#edit-gambar-preview').attr('src', '<?= base_url('uploads/pelatihan/') ?>' + edit_gambar);
            } else {
                $('#edit-gambar-preview').attr('src', '');
            }

            $('#ubahPelatihanModal').modal('show');
        });

        const editDropzone = new Dropzone("#edit_gambar_dropzone", {
            url: "<?= base_url('admin_v2/update_pelatihan') ?>",
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            dictDefaultMessage: "Seret gambar ke sini untuk unggah",
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            init: function() {
                var editDropzone = this;
                document.querySelector("#editPelatihanForm").addEventListener("submit", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (editDropzone.getQueuedFiles().length > 0) {
                        editDropzone.processQueue();
                    } else {
                        updatePelatihanWithoutImage();
                    }
                });
                this.on("sending", function(file, xhr, formData) {
                    formData.append("id", document.querySelector("#edit_id").value);
                    formData.append("judul", document.querySelector("#edit_judul").value);
                    formData.append("isi", document.querySelector("#edit_isi").value);
                    formData.append("tags", document.querySelector("#edit_tags").value);
                });
                this.on("success", function(file, response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pelatihan telah diperbarui.',
                        }).then((result) => {
                            $('#ubahPelatihanModal').modal('hide');
                            resetModal();
                            $('#tabelPelatihan').DataTable().ajax.reload();
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal memperbarui pelatihan.',
                        });
                    }
                });
                this.on("error", function(file, response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memperbarui pelatihan.',
                    });
                });
            }
        });

        function updatePelatihanWithoutImage() {
            $.ajax({
                url: "<?= base_url('admin_v2/update_pelatihan') ?>",
                type: 'POST',
                data: {
                    id: document.querySelector("#edit_id").value,
                    judul: document.querySelector("#edit_judul").value,
                    isi: document.querySelector("#edit_isi").value,
                    tags: document.querySelector("#edit_tags").value
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pelatihan telah diperbarui.',
                        }).then((result) => {
                            $('#ubahPelatihanModal').modal('hide');
                            resetModal();
                            $('#tabelPelatihan').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal memperbarui pelatihan.',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memperbarui pelatihan.',
                    });
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>