<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">

<style>
    #ubahGaleriModal .modal-dialog,
    #addGaleriBaruModal .modal-dialog {
        overflow-y: initial !important
    }

    #ubahGaleriModal .modal-body,
    #addGaleriBaruModal .modal-body {
        height: 70vh;
        overflow-y: auto;
    }

    .dz-preview.dz-image-preview {
        display: none;
    }

    .dz-started.dz-max-files-reached {
        display: none;
    }

    .invalid-feedback {
        color: red;
        font-size: 0.875em;
        margin-top: 0.25rem;
    }

    .image-container {
        position: relative;
        display: inline-block;
        margin: 5px;
    }

    .image-container img {
        display: block;
        width: 150px;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        opacity: 0;
        transition: opacity 0.3s;
        text-align: center;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .image-container:hover .image-overlay {
        opacity: 1;
    }

    .image-overlay .btn-group {
        display: flex;
        gap: 10px;
    }


    .image-overlay .btn i {
        font-size: 1.2em;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Galeri</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php site_url(); ?>dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Galeri</li>
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
                            <h3 class="card-title">Tabel Daftar Galeri</h3>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addGaleriBaruModal">
                                Tambah Galeri Baru
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tabelGaleri" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="w-5">No.</th>
                                        <th class="w-20">Kategori</th>
                                        <th class="w-75">Gambar</th>
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


<!-- Modal Tambah Galeri -->
<div class="modal fade" id="addGaleriBaruModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addGaleriBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGaleriBaruModalLabel">Modal Tambah Galeri Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadGaleriForm" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" class="form-control" name="status" id="status" value="1">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <span>Deskripsi</span>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="alert alert-warning" role="alert">
                                Pilih opsi Lainnya ... pada bagian Jenis Galeri berikut jika ingin menambahkan jenis Galeri baru!
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori" class="w-100 form-control" onchange="showInput(this)">
                                        <option value="">- Pilih -</option>
                                        <option value="Transmigrasi">Transmigrasi</option>
                                        <option value="P2KT">P2KT</option>
                                        <option value="Tenaga Kerja">Tenaga Kerja</option>
                                        <option value="lainnya">Lainnya ...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div id="inputLainnya" style="display: none;">
                                <label for="kategori_baru">Kategori Baru</label>
                                <input type="text" name="kategori_baru" id="kategori_baru" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <span>Gambar</span>
                                <div id="unggahGambarBaru" class="dropzone"></div>
                                <!-- Cropper Container -->
                                <div id="addGaleriCropper" style="display: none;">
                                    <img id="addGaleriImage" src="" alt="Cropper">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info" id="btnUnggahGaleri">Unggah Galeri Baru</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Edit Galeri-->
<div class="modal fade" id="ubahGaleriModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahGaleriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahGaleriModalLabel">Modal Sunting Galeri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editGaleriForm" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <input type="hidden" class="form-control" name="edit_status" id="edit_status" value="1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <span>Ubah Deskripsi</span>
                                <input type="text" class="form-control" id="edit_deskripsi" name="edit_deskripsi"></input>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="edit_kategori">Ubah Kategori</label>
                                    <select name="edit_kategori" id="edit_kategori" class="w-100 form-control" onchange="showInput(this)">
                                        <option value="">- Pilih -</option>
                                        <option value="Transmigrasi">Transmigrasi</option>
                                        <option value="P2KT">P2KT</option>
                                        <option value="Tenaga Kerja">Tenaga Kerja</option>
                                        <option value="lainnya">Lainnya ...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <span>Ubah Gambar</span>
                                <div id="edit_gambar_dropzone" class="dropzone"></div>
                                <img id="edit-gambar-preview" class="img-thumbnail mt-2" width="100">
                                <div id="updateGaleriCropper" style="display:none;">
                                    <img id="updateGaleriImage" src="" style="max-width:100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info">Perbarui Galeri</button>
                </div>
            </form>


        </div>
    </div>
</div>


<div class="modal fade" id="detailGaleriModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="detailGaleriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailGaleriModalLabel">Modal Detail Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <img id="detailUserImage" class="img-fluid rounded w-100" src="" alt="Gambar User">
                    </div>
                    <div class="col-lg-8">
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>ID</span>
                            </div>
                            <div class="col-md-9">
                                <strong id="detailUserId"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Kategori</span>
                            </div>
                            <div class="col-md-9">
                                <strong id="kategori_detail"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Deskripsi</span>
                            </div>
                            <div class="col-md-9">
                                <strong id="deskripsi_detail"></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    $(document).ready(function() {
        var base_url = '<?= base_url() ?>';
        // var base_url = $('meta[name="base-url"]').attr('content'); // Pastikan base_url tersedia di sini
        var tableGaleri = $('#tabelGaleri').DataTable({
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
                "url": "<?php echo base_url('admin_v2/galeriajax'); ?>", // Sesuaikan dengan route yang benar di CodeIgniter
                "type": "POST"
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "kategori"
                },
                {
                    "data": "gambar",
                    "render": function(data, type, row) {
                        var gambarArray = data.trim().split(' ');
                        var gambarHtml = gambarArray.map(function(gambar) {
                            // Pastikan gambar adalah nama file gambar, bukan HTML tag
                            return `
                                <div class="image-container">
                                    <img src="${base_url}uploads/galeri/${gambar.trim()}" alt="${row.deskripsi}" width="100">
                                    <div class="image-overlay">
                                        <div class="btn-group">
                                            ${row.aksi}
                                        </div>
                                    </div>
                                </div>
                            `;
                        }).join(' ');
                        return gambarHtml;
                    }
                },
            ]
        });

        $(document).on('click', '.btn-detail-galeri', function() {
            var userId = $(this).data('id');
            var deskripsi = $(this).data('deskripsi');
            var kategori = $(this).data('kategori');
            var userImage = $(this).data('gambar');

            // Masukkan data ke dalam modal
            $('#detailUserId').text(userId);
            $('#deskripsi_detail').text(deskripsi);
            $('#kategori_detail').text(kategori);

            // Tampilkan gambar user
            // $('#detailUserImage').attr('src', userImage);
            $('#detailUserImage').attr('src', base_url + '/uploads/galeri/' + userImage).show();
        });

        // Event listeners tetap sama
        $('#tabelGaleri').on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            var judul = $(this).data('judul');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus galeri ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: base_url + '/admin_v2/hapus_galeri',
                        type: 'POST',
                        data: {
                            id: id,
                            judul: judul
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                tableGaleri.ajax.reload();
                                Swal.fire('Sukses!', 'Galeri berhasil dihapus.', 'success');
                            } else {
                                Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus galeri.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus galeri.', 'error');
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-edit', function() {
            var edit_id = $(this).data('edit_id');
            var edit_kategori = $(this).data('edit_kategori');
            var edit_deskripsi = $(this).data('edit_deskripsi');
            var edit_gambar = $(this).data('edit_gambar');

            $('#edit_id').val(edit_id);
            $('#edit_deskripsi').val(edit_deskripsi);
            $('#edit_kategori').val(edit_kategori);

            if (edit_gambar) {
                $('#edit-gambar-preview').attr('src', base_url + '/uploads/galeri/' + edit_gambar).show();
            } else {
                $('#edit-gambar-preview').hide();
            }

            $('#ubahGaleriModal').modal('show');
        });

        // Status toggle
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

                fetch(base_url + '/admin_v2/update_status_galeri', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify({
                            id: id,
                            status: status
                        })
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Sukses', 'Status berhasil diperbarui.', 'success');
                        } else {
                            Swal.fire('Gagal', 'Gagal memperbarui status.', 'error');
                        }
                    }).catch(error => {
                        Swal.fire('Error', 'Terjadi kesalahan saat memperbarui status.', 'error');
                    });
            };
        });
    });
</script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {


        // Reset Modal setelah upload dan update data
        var cropper;

        const addDropzone = new Dropzone("#unggahGambarBaru", {
            url: "<?= base_url('admin_v2/save_galeri') ?>",
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
                        var image = document.getElementById('addGaleriImage');
                        image.src = event.target.result;

                        var cropperContainer = document.getElementById('addGaleriCropper');
                        cropperContainer.style.display = 'block';

                        cropper = new Cropper(image, {
                            aspectRatio: 16 / 9,
                            viewMode: 1,
                            responsive: true,
                            scalable: true,
                            zoomable: true,
                            autoCropArea: 1,
                            movable: true,
                            cropBoxResizable: true,
                            toggleDragModeOnDblclick: false,
                        });
                    };
                    reader.readAsDataURL(file);
                });

                // Event ketika form disubmit
                document.querySelector("#uploadGaleriForm").addEventListener("submit", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Lanjutkan jika tidak ada error
                    if (addDropzone.getQueuedFiles().length > 0) {
                        var canvas = cropper.getCroppedCanvas();
                        canvas.toBlob(function(blob) {
                            var file = new File([blob], addDropzone.getQueuedFiles()[0].name.replace(/\.\w+$/, ".webp"), {
                                type: 'image/webp',
                                lastModified: Date.now()
                            });

                            addDropzone.removeAllFiles();
                            addDropzone.addFile(file);

                            addDropzone.processQueue();
                        }, 'image/webp');
                    } else {
                        Swal.fire('Error', 'Gambar galeri belum diunggah.', 'error');
                    }
                });

                this.on("sending", function(file, xhr, formData) {
                    var jenisKategoriKode = document.querySelector("#kategori").value;
                    formData.append("deskripsi", document.querySelector("#deskripsi").value);
                    formData.append("kategori", jenisKategoriKode);
                    formData.append("status", document.querySelector("#status").value);

                    if (jenisKategoriKode === 'lainnya') {
                        var newJenisGaleri = document.querySelector("#kategori_baru").value;
                        formData.append("kategori_baru", newJenisGaleri);
                    }
                });

                this.on("success", function(file, response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Galeri baru telah diunggah.',
                        }).then((result) => {
                            $('#addGaleriBaruModal').modal('hide');
                            resetModal();
                            $('#tabelGaleri').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal unggah Galeri baru.',
                        });
                    }
                });

                this.on("error", function(file, response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal unggah Galeri baru.',
                    });
                });
            }
        });


        function resetModal() {
            var deskripsi = document.getElementById('deskripsi');
            var edit_deskripsi = document.getElementById('edit_deskripsi');
            var kategori = document.getElementById('kategori');
            var edit_kategori = document.getElementById('edit_kategori');

            if (deskripsi) {
                deskripsi.value = '';
            }
            if (edit_deskripsi) {
                edit_deskripsi.value = '';
            }
            if (kategori) {
                kategori.value = '';
            }
            if (edit_kategori) {
                edit_kategori.value = '';
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
            var croperUpdate = document.getElementById('updateGaleriCropper');
            croperUpdate.style.display = 'none';

            var cropperTambah = document.getElementById('addGaleriCropper');
            cropperTambah.style.display = 'none';
        }

        const editDropzone = new Dropzone("#edit_gambar_dropzone", {
            url: "<?= base_url('admin_v2/update_galeri') ?>",
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFiles: 1,
            dictDefaultMessage: "Seret gambar ke sini untuk unggah",
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            init: function() {
                var editDropzone = this;
                var cropper;

                this.on("addedfile", function(file) {
                    if (cropper) {
                        cropper.destroy();
                    }

                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var image = document.getElementById('updateGaleriImage');
                        image.src = event.target.result;

                        var cropperContainer = document.getElementById('updateGaleriCropper');
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
                            toggleDragModeOnDblclick: false
                        });
                    };
                    reader.readAsDataURL(file);
                });

                document.querySelector("#editGaleriForm").addEventListener("submit", function(e) {
                    e.preventDefault();

                    var valid = true;
                    var editDeskripsi = $('#edit_deskripsi').val().trim();

                    if (editDeskripsi === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: 'Deskripsi harus diisi.',
                        });
                        valid = false;
                    }

                    if (!valid) {
                        return;
                    }

                    if (editDropzone.getQueuedFiles().length > 0) {
                        var canvas = cropper.getCroppedCanvas();
                        canvas.toBlob(function(blob) {
                            var file = new File([blob], editDropzone.getQueuedFiles()[0].name.replace(/\.\w+$/, ".webp"), {
                                type: 'image/webp',
                                lastModified: Date.now()
                            });

                            editDropzone.removeAllFiles();
                            editDropzone.addFile(file);

                            editDropzone.processQueue();
                        }, 'image/webp');
                    } else {
                        updateGaleriWithoutImage();
                    }
                });

                this.on("sending", function(file, xhr, formData) {
                    formData.append("id", $("#edit_id").val());
                    formData.append("deskripsi", $("#edit_deskripsi").val());
                    formData.append("kategori", $("#edit_kategori").val());
                });

                this.on("success", function(file, response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Galeri telah diperbarui.',
                        }).then(() => {
                            $('#ubahGaleriModal').modal('hide');
                            $('#tabelGaleri').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal memperbarui galeri.',
                        });
                    }
                });

                this.on("error", function(file, response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memperbarui galeri.',
                    });
                });
            }
        });

        function updateGaleriWithoutImage() {
            var formData = new FormData(document.getElementById("editGaleriForm"));

            $.ajax({
                url: "<?= base_url('admin_v2/update_galeri') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Galeri telah diperbarui.',
                        }).then(() => {
                            $('#ubahGaleriModal').modal('hide');
                            $('#tabelGaleri').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal memperbarui galeri.',
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memperbarui galeri.',
                    });
                }
            });
        }
    });
</script>

<script>
    function showInput(select) {
        var inputLainnya = document.getElementById('inputLainnya');
        if (select.value === 'lainnya') {
            inputLainnya.style.display = 'block';
        } else {
            inputLainnya.style.display = 'none';
        }
    }
</script>
<?= $this->endSection() ?>