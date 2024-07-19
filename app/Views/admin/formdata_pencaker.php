<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Unggah Dokumen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Unggah Dokumen</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Form Unggah Dokumen yang Dibutuhkan</h3>
                </div>
                <div class="card-body">
                    <table id="tabelDokumen" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Dokumen</th>
                                <th>Nama Dokumen</th>
                                <th>Tanggal Unggah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="uploadDokumenModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="uploadDokumenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadDokumenModalLabel">Upload Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="uploadDokumenForm" enctype="multipart/form-data" method="post">
                <input type="hidden" name="dokumen_id" id="dokumen_id">
                <input type="hidden" name="jenis_dokumen_id" id="jenis_dokumen_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="jenis_dokumen">Jenis Dokumen</label>
                        <input type="text" name="jenis_dokumen" id="jenis_dokumen" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="dropzone" class="form-label">Unggah Dokumen</label>
                        <div id="unggahDokumen" class="dropzone"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btnUnggahDokumen" class="btn btn-primary">Unggah Dokumen</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        var tabelDokumen = $('#tabelDokumen').DataTable({
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
                "url": "<?php echo base_url('pencaker/dokajax'); ?>",
                "type": "POST"
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "jenis"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "tgl"
                },
                {
                    "data": "aksi"
                }
            ],
            "drawCallback": function(settings) {}
        });

        $('#tabelDokumen').on('click', '.deleteDokumen', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus dokumen ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('pencaker/hapus_dokumen') ?>',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                tabelDokumen.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses!',
                                    text: 'Dokumen berhasil dihapus.',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    showConfirmButton: false,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat menghapus dokumen.',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    showConfirmButton: false,
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus dokumen.',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                            });
                        }

                    });
                }
            });
        });
    });
</script>

<script>
    $(document).on('click', '.uplodDokumenBTN', function() {
        var id = $(this).data('id');
        var jenis = $(this).data('jenis');

        $('#dokumen_id').val(id);
        $('#jenis_dokumen_id').val(jenis);
        $('#jenis_dokumen').val(jenis);

        // Tampilkan modal upload dokumen jika perlu
        $('#uploadDokumenModal').modal('show');
    });

    function resetModal() {
        var jenis_dokumen = document.getElementById('jenis_dokumen');
        var namadokumen = document.getElementById('namadokumen');

        if (jenis_dokumen) {
            jenis_dokumen.value = '';
        }
        if (namadokumen) {
            namadokumen.value = '';
        }

        if (addDokumenDropzone) {
            addDokumenDropzone.removeAllFiles();
        }
    }

    // Dropzone untuk unggah dokumen
    const addDokumenDropzone = new Dropzone("#unggahDokumen", {
        url: "<?= base_url('pencaker/upload_dokumen') ?>",
        autoProcessQueue: false,
        uploadMultiple: false,
        maxFiles: 1,
        dictDefaultMessage: "Seret dokumen ke sini untuk unggah",
        addRemoveLinks: true,
        init: function() {
            var addDokumenDropzone = this;

            $('#uploadDokumenForm').submit(function(e) {
                e.preventDefault();
                e.stopPropagation();
                if (addDokumenDropzone.getQueuedFiles().length > 0) {
                    addDokumenDropzone.processQueue();
                } else {
                    Swal.fire('Error', 'Dokumen belum diunggah.', 'error');
                }
            });

            this.on("sending", function(file, xhr, formData) {
                const dokumenId = $('#dokumen_id').val();
                const jenisDokumen = $('#jenis_dokumen').val();

                formData.append("dokumen_id", dokumenId);
                formData.append("jenis_dokumen", jenisDokumen);

                const nik = '<?= user()->nik ?>';
                const fileExtension = file.name.split('.').pop();
                const fileName = nik + '_' + jenisDokumen + '.' + fileExtension;
                formData.append("file", file, fileName);
            });

            this.on("success", function(file, response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Dokumen berhasil diunggah.',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    }).then((result) => {
                        $('#uploadDokumenModal').modal('hide');
                        resetModal();
                        $('#tabelDokumen').DataTable().ajax.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.errors ? response.errors.join("<br>") : 'Gagal unggah dokumen.',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    });
                }
            });

            this.on("error", function(file, message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message,
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                });
                addDokumenDropzone.removeFile(file);
            });

            this.on("addedfile", function(file) {
                // Check file size
                if (file.size > 200 * 1024) { // 200 KB
                    this.removeFile(file);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ukuran file terlalu besar. Maksimal ukuran file adalah 200KB.',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    });
                }
            });

            // Update acceptedFiles saat modal dibuka
            $('#uploadDokumenModal').on('show.bs.modal', function() {
                const jenisDokumen = $('#jenis_dokumen').val();
                let acceptedFileTypes;

                if (jenisDokumen === 'PAS FOTO' || jenisDokumen === 'KTP') {
                    acceptedFileTypes = 'image/*';
                } else {
                    acceptedFileTypes = 'application/pdf';
                }

                addDokumenDropzone.options.acceptedFiles = acceptedFileTypes;
            });
        }
    });
</script>
<?= $this->endSection() ?>