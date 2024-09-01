<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>
<!-- Dropzone CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">

<style>
    .btn-group,
    .btn-group-vertical {
        position: relative;
        display: block !important;
        /* vertical-align: middle; */
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Galeri Kegiatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php site_url(); ?>dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Galeri Kegiatan</li>
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
                            <h3 class="card-title">Galeri Kegiatan</h3>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addGaleriModal">
                                Tambah Galeri Baru
                            </button>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="btn-group w-100 mb-2">
                                    <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All items </a>
                                    <?php foreach ($categories as $category): ?>
                                        <a class="btn btn-info" href="javascript:void(0)" data-filter="<?= htmlspecialchars($category['kategori']) ?>">
                                            Galeri <?= htmlspecialchars(ucfirst($category['kategori'])) ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div>
                                <div class="filter-container p-0 row">
                                    <?php foreach ($galeri as $item): ?>
                                        <div class="filtr-item col-sm-1" data-category="<?= htmlspecialchars($item['kategori']) ?>" data-sort="sample">
                                            <a href="<?= base_url('uploads/galeri/' . $item['gambar']) ?>" data-toggle="lightbox" data-title="<?= htmlspecialchars($item['kategori']) ?>">
                                                <img src="<?= base_url('uploads/galeri/' . $item['gambar']) ?>" class="img-fluid mb-2" alt="<?= htmlspecialchars($item['kategori']) ?>" />
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Adding Gallery -->
<!-- Modal for Adding Gallery -->
<div class="modal fade" id="addGaleriModal" tabindex="-1" role="dialog" aria-labelledby="addGaleriLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addGaleriLabel">Tambah Galeri Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="galeriForm" action="#" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select id="kategori" name="kategori" class="form-control">
                                    <!-- Opsi dropdown akan diisi oleh JavaScript -->
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group" id="kategoriLainnyaDiv" style="display: none;">
                                <label for="kategori_lainnya">Kategori Lainnya</label>
                                <input type="text" id="kategori_lainnya" name="kategori_lainnya" class="form-control" placeholder="Masukkan kategori baru">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="gambar">Upload Gambar</label>
                                <div class="dropzone" id="galeriDropzone">
                                    <div class="dz-message">
                                        Drop gambar di sini atau klik untuk memilih file.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" id="uploadButton" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;

    document.addEventListener("DOMContentLoaded", function() {
        var myDropzone = new Dropzone("#galeriDropzone", {
            url: "<?= base_url('admin_v2/upload_galeri') ?>",
            autoProcessQueue: false,
            acceptedFiles: "image/*",
            maxFilesize: 50,
            maxFiles: 20,
            addRemoveLinks: true,
            init: function() {
                var submitButton = document.querySelector("#uploadButton");
                var myDropzone = this;

                submitButton.addEventListener("click", function() {
                    var kategori = document.getElementById('kategori').value;

                    if (kategori === 'lainnya') {
                        kategori = document.getElementById('kategori_lainnya').value;
                    }

                    myDropzone.on('sending', function(file, xhr, formData) {
                        formData.append("kategori", kategori);
                    });

                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Tidak ada file yang dipilih untuk diupload.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });

                myDropzone.on("success", function(file, response) {
                    Swal.fire({
                        title: 'Sukses',
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        myDropzone.removeAllFiles();
                        document.getElementById('galeriForm').reset();
                        $('#addGaleriModal').modal('hide');

                        // Perbarui konten galeri
                        document.querySelector('#galeriContainer').innerHTML = response.data;
                    });
                });

                myDropzone.on("error", function(file, response) {
                    Swal.fire({
                        title: 'Error',
                        text: response.error || 'Gagal mengupload file.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            }
        });

        document.getElementById('kategori').addEventListener('change', function() {
            var kategoriLainnyaDiv = document.getElementById('kategoriLainnyaDiv');
            if (this.value === 'lainnya') {
                kategoriLainnyaDiv.style.display = 'block';
            } else {
                kategoriLainnyaDiv.style.display = 'none';
            }
        });

        var buttons = document.querySelectorAll('.btn-group .btn');
        var items = document.querySelectorAll('.filtr-item');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var filter = this.getAttribute('data-filter');

                buttons.forEach(function(btn) {
                    btn.classList.remove('active');
                });
                this.classList.add('active');

                items.forEach(function(item) {
                    if (filter === 'all' || item.getAttribute('data-category').includes(filter)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        $.ajax({
            url: '<?= base_url('admin_v2/get_categories') ?>',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var kategoriSelect = $('#kategori');
                kategoriSelect.empty(); // Kosongkan dropdown
                kategoriSelect.append('<option value="">- Pilih Kategori -</option>'); // Opsi default

                // Tambahkan opsi dari data yang diterima
                $.each(response.categories, function(index, kategori) {
                    kategoriSelect.append('<option value="' + kategori + '">' + kategori + '</option>');
                });

                // Tambahkan opsi untuk "lainnya" jika diperlukan
                kategoriSelect.append('<option value="lainnya">Lainnya</option>');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching categories:', error);
            }
        });
    });
</script>

<?= $this->endSection() ?>