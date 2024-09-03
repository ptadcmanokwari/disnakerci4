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

    .invalid-feedback {
        color: red;
        font-size: 0.875em;
        margin-top: 0.25rem;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pelatihan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php site_url(); ?>dashboard">Dashboard</a></li>
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
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addPelatihanBaruModal">
                                Tambah Pelatihan Baru
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tabelPelatihan" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Judul Pelatihan</th>
                                        <th>Deskripsi Pelatihan</th>
                                        <th>Jenis Pelatihan</th>
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
                    <div class="row">
                        <input type="hidden" class="form-control" name="status" id="status" value="1">
                        <input type="hidden" class="form-control" name="users_id" id="users-id" value="1">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Pelatihan</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <span>Deskripsi Pelatihan</span>
                                <textarea id="deskripsi" name="deskripsi"></textarea>
                                <div id="error-deskripsi" class="invalid-feedback" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <span>Materi Pelatihan</span>
                                <textarea id="materi" name="materi"></textarea>
                                <div id="error-materi" class="invalid-feedback" style="display:none;"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="jenis_pelatihan_kode">Jenis Pelatihan</label>
                                    <select name="jenis_pelatihan_kode" id="jenis_pelatihan_kode" class="w-100 form-control" onchange="showInput(this)">
                                        <option value="">- Pilih -</option>
                                        <?php foreach ($jenis_pelatihan as $pelatihan) : ?>
                                            <option value="<?= $pelatihan['kode']; ?>"><?= $pelatihan['pelatihan']; ?></option>
                                        <?php endforeach; ?>
                                        <option value="lainnya">Lainnya (Jenis Pelatihan Baru)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div id="inputLainnya" style="display: none;">
                                <label for="new_jenis_pelatihan">Jenis Pelatihan Baru</label>
                                <input type="text" name="new_jenis_pelatihan" id="new_jenis_pelatihan" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="link" class="form-label">Link IKuti Pelatihan (Google Form, dll.)</label>
                                <input type="text" class="form-control" id="link" name="link" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="tgl_pelatihan" class="form-label">Tanggal Pelatihan</label>
                                <input type="datetime-local" class="form-control" id="tgl_pelatihan" name="tgl_pelatihan" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <span>Gambar Pelatihan</span>
                                <div id="unggahGambarBaru" class="dropzone"></div>
                                <!-- Cropper Container -->
                                <div id="addPelatihanCropper" style="display: none;">
                                    <img id="addPelatihanImage" src="" alt="Cropper">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info" id="btnUnggahPelatihan">Unggah Pelatihan Baru</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Edit Pelatihan-->
<div class="modal fade" id="ubahPelatihanBaruModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahPelatihanBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahPelatihanBaruModalLabel">Modal Sunting Pelatihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editPelatihanForm" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <input type="hidden" class="form-control" name="edit_status" id="edit_status" value="1">
                    <input type="hidden" class="form-control" name="edit_users-id" id="edit_users-id" value="1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="edit_judul" class="form-label">Ubah Judul Pelatihan</label>
                                <input type="text" class="form-control" id="edit_judul" name="edit_judul">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <span>Ubah Deskripsi Pelatihan</span>
                                <textarea id="edit_deskripsi" name="edit_deskripsi"></textarea>
                                <div id="error-edit_deskripsi" class="invalid-feedback" style="display:none;">Deskripsi Pelatihan harus diisi.</div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <span>Ubah Materi Pelatihan</span>
                                <textarea id="edit_materi" name="edit_materi"></textarea>
                                <div id="error-edit_materi" class="invalid-feedback" style="display:none;">Materi Pelatihan harus diisi.</div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="edit_jenis_pelatihan" class="form-label">Ubah Jenis Pelatihan</label>
                                <select class="form-control" id="edit_jenis_pelatihan" name="edit_jenis_pelatihan">
                                    <!-- Options will be dynamically loaded here -->
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="edit_link" class="form-label">Ubah Link Pelatihan (Google Form, dll.)</label>
                                <input type="text" class="form-control" id="edit_link" name="edit_link">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="edit_tgl_pelatihan" class="form-label">Tanggal Pelatihan</label>
                                <input type="datetime-local" class="form-control" id="edit_tgl_pelatihan" name="edit_tgl_pelatihan" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <span>Ubah Gambar</span>
                                <div id="edit_gambar_dropzone" class="dropzone"></div>
                                <img id="edit-gambar-preview" class="img-thumbnail mt-2" width="100">
                                <div id="updatePelatihanCropper" style="display:none;">
                                    <img id="updatePelatihanImage" src="" style="max-width:100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info">Perbarui Pelatihan</button>
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
        var tablePelatihan = $('#tabelPelatihan').DataTable({
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
                    "data": "deskripsi"
                },
                {
                    "data": "pelatihan"
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

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus Pelatihan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('admin_v2/hapus_pelatihan') ?>',
                        type: 'POST',
                        data: {
                            id: id,
                            judul: judul
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                tablePelatihan.ajax.reload();
                                Swal.fire(
                                    'Sukses!',
                                    'Pelatihan berhasil dihapus.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus Pelatihan.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus Pelatihan.',
                                'error'
                            );
                        }
                    });
                }
            });
        });


        $('#deskripsi').summernote();
        $('#edit_deskripsi').summernote();
        $('#materi').summernote();
        $('#edit_materi').summernote();

        // Reset Modal setelah upload dan update data
        var cropper;

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

                // Event ketika file ditambahkan
                this.on("addedfile", function(file) {
                    if (cropper) {
                        cropper.destroy();
                    }

                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var image = document.getElementById('addPelatihanImage');
                        image.src = event.target.result;

                        var cropperContainer = document.getElementById('addPelatihanCropper');
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
                document.querySelector("#uploadPelatihanForm").addEventListener("submit", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Validasi Summernote Deskripsi
                    var deskripsiContent = $('#deskripsi').summernote('isEmpty');
                    if (deskripsiContent) {
                        $('#error-deskripsi').text('Deskripsi Pelatihan tidak boleh kosong.').show();
                        return false;
                    } else {
                        $('#error-deskripsi').hide();
                    }

                    // Validasi Summernote Materi
                    var materiContent = $('#materi').summernote('isEmpty');
                    if (materiContent) {
                        $('#error-materi').text('Materi Pelatihan tidak boleh kosong.').show();
                        return false;
                    } else {
                        $('#error-materi').hide();
                    }

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
                        Swal.fire('Error', 'Gambar Pelatihan belum diunggah.', 'error');
                    }
                });

                this.on("sending", function(file, xhr, formData) {
                    var jenisPelatihanKode = document.querySelector("#jenis_pelatihan_kode").value;
                    formData.append("judul", document.querySelector("#judul").value);
                    formData.append("deskripsi", document.querySelector("#deskripsi").value);
                    formData.append("materi", document.querySelector("#materi").value);
                    formData.append("tgl_pelatihan", document.querySelector("#tgl_pelatihan").value);
                    formData.append("jenis_pelatihan_kode", jenisPelatihanKode);
                    formData.append("status", document.querySelector("#status").value);
                    formData.append("link", document.querySelector("#link").value);
                    formData.append("users_id", document.querySelector("#users-id").value);

                    if (jenisPelatihanKode === 'lainnya') {
                        var newJenisPelatihan = document.querySelector("#new_jenis_pelatihan").value;
                        formData.append("new_jenis_pelatihan", newJenisPelatihan);
                    }
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
                            text: response.errors ? response.errors.join("<br>") : 'Gagal unggah Pelatihan baru.',
                        });
                    }
                });

                this.on("error", function(file, response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal unggah Pelatihan baru.',
                    });
                });
            }
        });


        function resetModal() {
            var judul = document.getElementById('judul');
            var edit_judul = document.getElementById('edit_judul');
            var new_jenis_pelatihan = document.getElementById('new_jenis_pelatihan');
            var jenis_pelatihan_kode = document.getElementById('jenis_pelatihan_kode');
            var edit_jenis_pelatihan_kode = document.getElementById('edit_jenis_pelatihan_kode');
            var link = document.getElementById('link');
            var deskripsi = $('#deskripsi');
            var materi = $('#materi');
            var edit_materi = $('#edit_materi');
            var tgl_pelatihan = $('#tgl_pelatihan');
            var edit_tgl_pelatihan = $('#edit_tgl_pelatihan');
            var edit_deskripsi = $('#edit_deskripsi');

            if (judul) {
                judul.value = '';
            }
            if (edit_judul) {
                edit_judul.value = '';
            }
            if (deskripsi) {
                deskripsi.summernote('code', '');
            }
            if (materi) {
                materi.summernote('code', '');
            }
            if (edit_materi) {
                edit_materi.summernote('code', '');
            }
            if (edit_deskripsi) {
                edit_deskripsi.summernote('code', '');
            }
            if (link) {
                link.value = '';
            }
            if (new_jenis_pelatihan) {
                new_jenis_pelatihan.value = '';
            }
            if (jenis_pelatihan_kode) {
                jenis_pelatihan_kode.value = '';
            }
            if (tgl_pelatihan) {
                tgl_pelatihan.value = '';
            }
            if (edit_tgl_pelatihan) {
                edit_tgl_pelatihan.value = '';
            }
            if (edit_jenis_pelatihan_kode) {
                edit_jenis_pelatihan_kode.value = '';
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
            var croperUpdate = document.getElementById('updatePelatihanCropper');
            croperUpdate.style.display = 'none';

            var cropperTambah = document.getElementById('addPelatihanCropper');
            cropperTambah.style.display = 'none';
        }

        $(document).on('click', '.btn-edit', function() {
            var edit_id = $(this).data('edit_id');
            var edit_judul = $(this).data('edit_judul');
            var edit_deskripsi = $(this).data('edit_deskripsi');
            var edit_materi = $(this).data('edit_materi');
            var edit_tgl_pelatihan = $(this).data('edit_tgl_pelatihan');
            var edit_gambar = $(this).data('edit_gambar');
            var edit_kode_pelatihan = $(this).data('edit_kode');
            var edit_link = $(this).data('edit_link');
            // Set data ke dalam modal
            $('#edit_id').val(edit_id);
            $('#edit_judul').val(edit_judul);
            $('#edit_link').val(edit_link);
            $('#edit_tgl_pelatihan').val(edit_tgl_pelatihan);
            $('#edit_deskripsi').summernote('code', edit_deskripsi);
            $('#edit_materi').summernote('code', edit_materi);

            if (edit_gambar) {
                $('#edit-gambar-preview').attr('src', '<?= base_url('uploads/pelatihan/') ?>' + edit_gambar);
            } else {
                $('#edit-gambar-preview').attr('src', '');
            }

            // Populate the dropdown
            $.ajax({
                url: '<?= base_url('admin_v2/get_jenis_pelatihan') ?>', // URL to fetch the list of pelatihan
                method: 'GET',
                success: function(response) {
                    var dropdown = $('#edit_jenis_pelatihan');
                    dropdown.empty(); // Clear any existing options

                    $.each(response, function(index, item) {
                        dropdown.append('<option value="' + item.kode + '">' + item.pelatihan + '</option>');
                    });

                    // Set the selected pelatihan
                    dropdown.val(edit_kode_pelatihan);
                }
            });

            $('#ubahPelatihanBaruModal').modal('show');
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
                var cropper;

                // Event ketika file ditambahkan
                this.on("addedfile", function(file) {
                    if (cropper) {
                        cropper.destroy();
                    }

                    var reader = new FileReader();
                    reader.onload = function(event) {
                        var image = document.getElementById('updatePelatihanImage');
                        image.src = event.target.result;

                        var cropperContainer = document.getElementById('updatePelatihanCropper');
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
                document.querySelector("#editPelatihanForm").addEventListener("submit", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Validasi input Summernote
                    var editDeskripsi = $('#edit_deskripsi').summernote('isEmpty') ? '' : $('#edit_deskripsi').val();
                    var editMateri = $('#edit_materi').summernote('isEmpty') ? '' : $('#edit_materi').val();

                    var valid = true;

                    if (editDeskripsi.trim() === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: 'Deskripsi Pelatihan harus diisi.',
                        });
                        valid = false;
                    }

                    if (editMateri.trim() === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: 'Materi Pelatihan harus diisi.',
                        });
                        valid = false;
                    }

                    // Hentikan proses jika tidak valid
                    if (!valid) {
                        return;
                    }

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
                        updatePelatihanWithoutImage();
                    }
                });

                this.on("sending", function(file, xhr, formData) {
                    formData.append("id", document.querySelector("#edit_id").value);
                    formData.append("judul", document.querySelector("#edit_judul").value);
                    formData.append("deskripsi", document.querySelector("#edit_deskripsi").value);
                    formData.append("materi", document.querySelector("#edit_materi").value);
                    formData.append("link", document.querySelector("#edit_link").value);
                    formData.append("tgl_pelatihan", document.querySelector("#edit_tgl_pelatihan").value);
                    formData.append("jenis_pelatihan_kode", document.querySelector("#edit_jenis_pelatihan").value);
                });

                this.on("success", function(file, response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pelatihan telah diperbarui.',
                        }).then((result) => {
                            $('#ubahPelatihanBaruModal').modal('hide');
                            resetModal();
                            $('#tabelPelatihan').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal memperbarui Pelatihan.',
                        });
                    }
                });

                this.on("error", function(file, response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memperbarui Pelatihan.',
                    });
                });
            }
        });

        function updatePelatihanWithoutImage() {
            var formData = new FormData();
            formData.append("id", document.querySelector("#edit_id").value);
            formData.append("judul", document.querySelector("#edit_judul").value);
            formData.append("deskripsi", $('#edit_deskripsi').summernote('code'));
            formData.append("materi", $('#edit_materi').summernote('code'));
            formData.append("link", document.querySelector("#edit_link").value);
            formData.append("tgl_pelatihan", document.querySelector("#edit_tgl_pelatihan").value);
            formData.append("jenis_pelatihan_kode", document.querySelector("#edit_jenis_pelatihan").value);

            $.ajax({
                url: "<?= base_url('admin_v2/update_pelatihan') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pelatihan telah diperbarui.',
                        }).then((result) => {
                            $('#ubahPelatihanBaruModal').modal('hide');
                            resetModal();
                            $('#tabelPelatihan').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.errors ? response.errors.join("<br>") : 'Gagal memperbarui Pelatihan.',
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memperbarui Pelatihan.',
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