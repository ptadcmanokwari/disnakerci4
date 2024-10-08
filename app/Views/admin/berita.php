<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">

<style>
    .modal-dialog {
        overflow-y: initial !important
    }

    .modal-body {
        height: 70vh;
        overflow-y: auto;
    }

    .dz-preview.dz-image-preview {
        display: none;
    }

    .dz-started.dz-max-files-reached {
        display: none;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Berita</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php site_url(); ?>dashboard">Dashboard</a></li>
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
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addBeritaBaruModal">
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
                        <input type="text" class="form-control" name="tags" id="tags" required>
                    </div>

                    <div class="mb-3">
                        <span>Gambar Berita</span>
                        <div id="unggahGambarBaru" class="dropzone"></div>
                        <!-- Cropper Container -->
                        <div id="addBeritaCropper" style="display: none;">
                            <img id="addBeritaImage" src="" alt="Cropper">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info" id="btnUnggahBerita">Unggah Berita Baru</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Edit Berita-->
<div class="modal fade" id="ubahBeritaBaruModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahBeritaBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahBeritaBaruModalLabel">Modal Sunting Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editBeritaForm" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <input type="hidden" class="form-control" name="edit_kategori" id="edit_kategori" value="berita">
                    <div class="mb-3">
                        <label for="edit_judul" class="form-label">Ubah Judul Berita</label>
                        <input type="text" class="form-control" id="edit_judul" name="edit_judul">
                    </div>
                    <div class="mb-3">
                        <span>Ubah Isi Berita</span>
                        <textarea id="edit_isi" name="edit_isi"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tags">Ubah Tags Berita</label>
                        <input type="text" class="form-control" name="edit_tags" id="edit_tags">
                    </div>
                    <input type="hidden" class="form-control" name="edit_status" id="edit_status" value="1">
                    <input type="hidden" class="form-control" name="edit_users-id" id="edit_users-id" value="1">
                    <div class="mb-3">
                        <span>Ubah Gambar</span>
                        <div id="edit_gambar_dropzone" class="dropzone"></div>
                        <img id="edit-gambar-preview" class="img-thumbnail mt-2" width="100">
                        <div id="updateBeritaCropper" style="display:none;">
                            <img id="updateBeritaImage" src="" style="max-width:100%;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info">Perbarui Berita</button>
                </div>
            </form>


        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        var tableBerita = $('#tabelBerita').DataTable({
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
                "url": "<?php echo base_url('admin_v2/beritaajax'); ?>",
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
                        html.switchery = switchery;
                    }

                    html.onchange = function() {
                        var status = this.checked ? 1 : 0;
                        var id = this.getAttribute('data-id');

                        // Kirim AJAX request untuk memperbarui status di server
                        fetch('<?= base_url('admin_v2/update_status_berita') ?>', {
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
            var judul = $(this).data('judul');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus berita ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('admin_v2/hapus_berita') ?>',
                        type: 'POST',
                        data: {
                            id: id,
                            judul: judul
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                tableBerita.ajax.reload();
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


        $('#isi').summernote();
        $('#edit_isi').summernote();

        // Reset Modal setelah upload dan update data
        var cropper;

        const addDropzone = new Dropzone("#unggahGambarBaru", {
            url: "<?= base_url('admin_v2/save_berita') ?>",
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            dictDefaultMessage: "Seret gambar ke sini untuk unggah",
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            init: function() {
                var addDropzone = this;

                // Event ketika file ditambahkan
                this.on("addedfile", function(file) {
                    if (cropper) {
                        cropper.destroy();
                    }

                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var image = document.getElementById('addBeritaImage');
                        image.src = event.target.result;

                        var cropperContainer = document.getElementById('addBeritaCropper');
                        cropperContainer.style.display = 'block';

                        cropper = new Cropper(image, {
                            aspectRatio: 16 / 9,
                            viewMode: 1,
                            responsive: true,
                            scalable: false,
                            zoomable: false,
                            autoCropArea: 1,
                            movable: true,
                            cropBoxResizable: true,
                            toggleDragModeOnDblclick: false,
                            ready: function() {
                                cropper.setCanvasData({
                                    left: 0,
                                    top: 0,
                                    width: 100,
                                    height: 'auto'
                                });
                            }
                        });
                    };
                    reader.readAsDataURL(file);
                });

                // Event ketika form disubmit
                document.querySelector("#uploadBeritaForm").addEventListener("submit", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (addDropzone.getQueuedFiles().length > 0) {
                        // Process cropped image
                        var canvas = cropper.getCroppedCanvas();
                        canvas.toBlob(function(blob) {
                            // Create a new file with .webp extension
                            var file = new File([blob], addDropzone.getQueuedFiles()[0].name.replace(/\.\w+$/, ".webp"), {
                                type: 'image/webp',
                                lastModified: Date.now()
                            });

                            // Replace old file with cropped file
                            addDropzone.removeAllFiles();
                            addDropzone.addFile(file);

                            addDropzone.processQueue();
                        }, 'image/webp');
                    } else {
                        Swal.fire('Error', 'Gambar berita belum diunggah.', 'error');
                    }
                });

                this.on("sending", function(file, xhr, formData) {
                    formData.append("kategori", document.querySelector("#kategori").value);
                    formData.append("judul", document.querySelector("#judul").value);
                    formData.append("isi", document.querySelector("#isi").value);
                    formData.append("tags", document.querySelector("#tags").value);
                });

                this.on("success", function(file, response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berita baru telah diunggah.',
                        }).then((result) => {
                            $('#addBeritaBaruModal').modal('hide');
                            resetModal();
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

            // Hapus Cropper jika ada
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }

            $('#edit-gambar-preview').attr('src', '');

            // Sembunyikan Cropper container
            var croperUpdate = document.getElementById('updateBeritaCropper');
            croperUpdate.style.display = 'none';

            var cropperTambah = document.getElementById('addBeritaCropper');
            cropperTambah.style.display = 'none';
        }

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
                $('#edit-gambar-preview').attr('src', '<?= base_url('uploads/berita/') ?>' + edit_gambar);
            } else {
                $('#edit-gambar-preview').attr('src', '');
            }

            $('#ubahBeritaBaruModal').modal('show');
        });

        const editDropzone = new Dropzone("#edit_gambar_dropzone", {
            url: "<?= base_url('admin_v2/update_berita') ?>",
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            dictDefaultMessage: "Seret gambar ke sini untuk unggah",
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            init: function() {
                var editDropzone = this;
                var cropper;

                // Event ketika file ditambahkan
                this.on("addedfile", function(file) {
                    if (cropper) {
                        cropper.destroy();
                    }

                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var image = document.getElementById('updateBeritaImage');
                        image.src = event.target.result;

                        var cropperContainer = document.getElementById('updateBeritaCropper');
                        cropperContainer.style.display = 'block';

                        cropper = new Cropper(image, {
                            aspectRatio: 16 / 9,
                            viewMode: 1,
                            responsive: true,
                            scalable: false,
                            zoomable: false,
                            autoCropArea: 1,
                            movable: true,
                            cropBoxResizable: true,
                            toggleDragModeOnDblclick: false,
                            ready: function() {
                                cropper.setCanvasData({
                                    left: 0,
                                    top: 0,
                                    width: 100,
                                    height: 'auto'
                                });
                            }
                        });
                    };
                    reader.readAsDataURL(file);
                });

                // Event ketika form disubmit
                document.querySelector("#editBeritaForm").addEventListener("submit", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (editDropzone.getQueuedFiles().length > 0) {
                        // Process cropped image
                        var canvas = cropper.getCroppedCanvas();
                        canvas.toBlob(function(blob) {
                            // Create a new file with .webp extension
                            var file = new File([blob], editDropzone.getQueuedFiles()[0].name.replace(/\.\w+$/, ".webp"), {
                                type: 'image/webp',
                                lastModified: Date.now()
                            });

                            // Replace old file with cropped file
                            editDropzone.removeAllFiles();
                            editDropzone.addFile(file);

                            editDropzone.processQueue();
                        }, 'image/webp');
                    } else {
                        updateBeritaWithoutImage();
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
                            text: 'Berita telah diperbarui.',
                        }).then((result) => {
                            $('#ubahBeritaBaruModal').modal('hide');
                            resetModal();
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
                url: "<?= base_url('admin_v2/update_berita') ?>",
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
                            text: 'Berita telah diperbarui.',
                        }).then((result) => {
                            $('#ubahBeritaBaruModal').modal('hide');
                            resetModal();
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
    });
</script>
<?= $this->endSection() ?>