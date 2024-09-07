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

    /* Tombol di atas gambar */
    .image-container {
        position: relative;
        display: inline-block;
    }

    .image-container img {
        display: block;
        width: 100%;
        height: auto;
    }

    .overlay-buttons {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        width: 100%;
        background-color: rgba(0, 0, 0, .5) !important;
        height: 100% !important;
    }

    .overlay-buttons button,
    .overlay-buttons input[type="checkbox"] {
        margin: 0 2px;
        padding: 5px 8px;
        height: 32px;
        width: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .overlay-buttons button i {
        font-size: 1.2rem;
    }

    .image-container:hover .overlay-buttons {
        display: flex;
    }

    .switchery>small {
        height: 25px;
        width: 25px;
    }

    .switchery {
        height: 25px;
        width: 45px;
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
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label for="filterHalaman">Pilih Halaman:</label>
                                    <select id="filterHalaman" class="form-control">
                                        <option value="Semua">Semua</option>
                                        <?php if (!empty($halaman) && is_array($halaman)) : ?>
                                            <?php foreach ($halaman as $hal) : ?>
                                                <option value="<?= $hal ?>">Galeri <?= ucwords(str_replace('_', ' ', $hal)) ?></option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="Tidak ada">Tidak ada halaman</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="filterKategori">Pilih Kategori:</label>
                                    <select id="filterKategori" class="form-control">
                                        <option value="Semua">Semua</option>
                                        <?php if (!empty($categories) && is_array($categories)) : ?>
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?= esc($category) ?>"><?= esc(str_replace('_', ' ', $category)) ?></option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="Tidak ada">Tidak ada kategori</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row" id="galeriContainer">
                                <?php foreach ($galeri as $key) : ?>
                                    <div class="col-md-1  my-2 galeri-item" data-kategori="<?= esc($key['kategori']); ?>" data-halaman="<?= esc($key['halaman']); ?>">
                                        <div class="image-container">
                                            <img class="w-100" src="<?= base_url(); ?>uploads/galeri/<?= esc($key['gambar']); ?>" alt="<?= esc($key['deskripsi']); ?>">
                                            <div class="overlay-buttons">
                                                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?= esc($key['id']); ?>">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <button type="button" class="btn btn-info btn-sm" data-id="<?= esc($key['id']); ?>" data-toggle="modal" data-target="#detailGaleriModal<?= esc($key['id']); ?>">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <input type="checkbox" class="js-switch" data-id="<?= esc($key['id']); ?>" <?= $key['status'] ? 'checked' : '' ?> />
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
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
                <h5 class="modal-title" id="addGaleriBaruModalLabel">Modal Tambah Gambar Galeri</h5>
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
                                <span>Deskripsi Gambar</span>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori" class="w-100 form-control" onchange="showInput(this)">
                                        <option value="">- Pilih -</option>
                                        <?php if (!empty($categories) && is_array($categories)) : ?>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= esc($category) ?>"><?= esc(str_replace('_', ' ', $category)) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <option value="lainnya">Lainnya (Kategori Baru)</option>
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
                            <span class="">Halaman untuk Menampilkan gambar</span>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="beranda" name="halaman" value="beranda">
                                    <label for="beranda" class="custom-control-label">Galeri Beranda</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="transmigrasi" name="halaman" value="transmigrasi">
                                    <label for="transmigrasi" class="custom-control-label">Galeri Urusan Transmigrasi</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="tenaga_kerja" name="halaman" value="tenaga_kerja">
                                    <label for="tenaga_kerja" class="custom-control-label">Galeri Urusan Tenaga Kerja</label>
                                </div>
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

<!-- Modal Detail Galeri -->
<?php foreach ($galeri as $key) : ?>
    <div class="modal fade" id="detailGaleriModal<?= $key['id']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="detailGaleriModal<?= $key['id']; ?>Label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailGaleriModal<?= $key['id']; ?>Label">Modal Detail Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <img id="detailUserImage" class="img-fluid rounded w-100" src="<?= base_url(); ?>uploads/galeri/<?= $key['gambar']; ?>" alt="<?= $key['deskripsi']; ?>">
                        </div>
                        <div class="col-lg-12">
                            <div class="row my-2">
                                <div class="col-md-3">
                                    <span>Kategori</span>
                                </div>
                                <div class="col-md-9">
                                    <strong id="kategori_detail">: <?= $key['kategori']; ?></strong>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-3">
                                    <span>Deskripsi</span>
                                </div>
                                <div class="col-md-9">
                                    <strong id="deskripsi_detail">: <?= $key['deskripsi']; ?></strong>
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
<?php endforeach; ?>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {

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
                    var halaman = document.querySelector('input[name="halaman"]:checked').value;

                    formData.append("deskripsi", document.querySelector("#deskripsi").value);
                    formData.append("kategori", jenisKategoriKode);
                    formData.append("status", document.querySelector("#status").value);
                    formData.append("halaman", halaman); // Menambahkan nilai halaman yang dipilih

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
                            if (result.isConfirmed) {
                                $('#addGaleriBaruModal').modal('hide');
                                resetModal();
                                location.reload();
                            }
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
            var kategori_baru = document.getElementById('kategori_baru');
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
            if (kategori_baru) {
                kategori_baru.value = '';
            }
            if (edit_kategori) {
                edit_kategori.value = '';
            }
            if (addDropzone) {
                addDropzone.removeAllFiles();
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

        $(document).on('click', '.btn-delete', function() {
            var id = $(this).data('id');

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
                        url: "<?php echo base_url('admin_v2/hapus_galeri') ?>",
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire('Sukses!', 'Galeri berhasil dihapus.', 'success').then(() => {
                                    location.reload(); // Refresh halaman setelah konfirmasi
                                });
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

        document.getElementById('filterKategori').addEventListener('change', function() {
            var selectedCategory = this.value;
            var galeriItems = document.querySelectorAll('.galeri-item');

            galeriItems.forEach(function(item) {
                if (selectedCategory === "Semua" || item.getAttribute('data-kategori') === selectedCategory) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });

        document.getElementById('filterHalaman').addEventListener('change', function() {
            var selectedHalaman = this.value;
            var halamanItems = document.querySelectorAll('.galeri-item');

            halamanItems.forEach(function(item) {
                if (selectedHalaman === "Semua" || item.getAttribute('data-halaman') === selectedHalaman) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function(html) {
            if (!html.switchery) {
                var switchery = new Switchery(html, {
                    size: 'medium'
                });
                html.switchery = switchery;
            }

            html.onchange = function() {
                var status = this.checked ? 1 : 0;
                var id = this.getAttribute('data-id');

                // Kirim AJAX request untuk memperbarui status di server
                fetch('<?= base_url('admin_v2/update_status_galeri') ?>', {
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