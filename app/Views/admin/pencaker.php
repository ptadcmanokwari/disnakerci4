<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pencari Kerja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pencari Kerja</li>
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
                            <h3 class="card-title">Tabel Daftar Pencari Kerja</h3>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserBaruModal">
                                Add New User
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tabelPencaker" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Verifikasi/Validasi</th>
                                        <th>Image</th>
                                        <th>Nama</th>
                                        <th>No. Pendaftaran</th>
                                        <th>NIK</th>
                                        <th>No. HP</th>
                                        <th>Email</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan dimuat oleh DataTables -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery dan DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- Custom script untuk inisialisasi DataTables -->
<script>
    $(document).ready(function() {
        var tabelPencaker = $('#tabelPencaker').DataTable({
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
                "url": "<?php echo base_url('admin/pencakerajax'); ?>",
                "type": "POST",
                "error": function(xhr, error, thrown) {
                    console.log("AJAX error:", error);
                    console.log("Status:", xhr.status);
                    console.log("Response:", xhr.responseText);
                }
            },
            "columns": [{
                    "data": "verval"
                },
                {
                    "data": "img"
                },
                {
                    "data": "namalengkap"
                },
                {
                    "data": "nopendaftaran"
                },
                {
                    "data": "nik"
                },
                {
                    "data": "phone"
                },
                {
                    "data": "email"
                },
                {
                    "data": "keterangan_status"
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
                        fetch('<?= base_url('admin/update_status_pencaker') ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                                },
                                body: JSON.stringify({
                                    id: id,
                                    status: status
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: 'Status successfully updated.'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Failed to update status.'
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'An error occurred while updating status.'
                                });
                            });
                    };
                });
            }
        });


        $('#tabelPencaker').on('click', '.btn-delete', function() {
            var pencakerId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus pencaker ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('admin/hapus_pencaker') ?>',
                        type: 'POST',
                        data: {
                            pencakerID: pencakerId // Sesuaikan dengan nama yang digunakan di controller
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                tabelPencaker.ajax.reload();
                                Swal.fire(
                                    'Sukses!',
                                    'Pencaker berhasil dihapus.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus pencaker.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus pencaker.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

    });
</script>

<?= $this->endSection() ?>