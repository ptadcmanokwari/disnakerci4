<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pencari Kerja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php site_url(); ?>dashboard">Dashboard</a></li>
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
                        </div>
                        <div class="card-body">
                            <div class="row d-flex justify-content-between align-items-center mb-2">
                                <div class="col-lg-4">
                                    <div class="form-group d-flex align-items-center m-0">
                                        <label class="w-50 m-0" for="filter_pencaker">Pilih Filter:</label>
                                        <select name="filter_pencaker" id="filter_pencaker" class="form-control filter_pencaker">
                                            <option value="">-- Pilih Salah Satu --</option>
                                            <option value="Registrasi">Registrasi</option>
                                            <option value="Verifikasi">Verifikasi</option>
                                            <option value="Validasi">Validasi</option>
                                            <option value="Aktif">Aktif</option>
                                            <option value="Lapor">Lapor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 d-flex justify-content-end align-items-center">
                                    <a href="<?= base_url('admin_v2/downloadpdf') ?>" type="button" class="btn btn-success btn-sm">
                                        <i class="bi bi-file-pdf"></i> Unduh PDF
                                    </a>
                                    <a href="<?= base_url('admin_v2/downloadexcel') ?>" type="button" class="btn btn-info btn-sm">
                                        <i class="bi bi-file-excel"></i> Unduh Excel
                                    </a>
                                </div>
                            </div>
                            <table id="tabelPencaker" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Verifikasi</th>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Modal Verifikasi/Validasi -->
<div class="modal fade" id="VerValModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="VerValModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="VerValModalLabel">Verifikasi/Validasi Pencaker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nopendaftaran">Nomor Pendaftaran</label>
                        <input class="form-control" name="nopendaftaran" id="nopendaftaran" type="text" disabled>
                    </div>
                    <div class="form-group">
                        <label for="namalengkap">Nama Pencaker</label>
                        <input class="form-control" id="namalengkap" name="namalengkap" type="text" disabled>
                    </div>

                    <span>Keterangan</span>
                    <select class="form-control" name="statusverifikasi" id="statusverifikasi">
                        <option value="">-- Pilih Salah Satu --</option>
                        <option value="ver_tidaklengkap">Tidak Lengkap</option>
                        <option value="ver_lengkap">Telah Diverifikasi</option>
                        <option value="ver_valid">Aktif</option>
                    </select>

                    <div id="pesanVerifikasi" class="form-group mt-3 hide">
                        <div class="form-group">
                            <label class="col-form-label w-100" for="dokumen">Dokumen</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="PAS FOTO" name="jenis_dokumen[]" id="d_pasfoto">
                                <label class="form-check-label" for="pasfoto">
                                    PAS FOTO
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="KTP" name="jenis_dokumen[]" id="d_ktp">
                                <label class="form-check-label" for="ktp">
                                    KTP
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="IJAZAH TERAKHIR" name="jenis_dokumen[]" id="d_ijazah">
                                <label class="form-check-label" for="ijazah">
                                    IJAZAH TERAKHIR
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="pesan">Catatan</label>
                            <textarea type="text" class="form-control form-control-sm" name="pesan" id="pesan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="usersid" name="usersid">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" id="saveVerifikasi" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery dan DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
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
                "url": "<?php echo base_url('admin_v2/pencakerajax'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.filter = $('#filter_pencaker').val(); // Kirim nilai filter
                },

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
                    "data": "nohp"
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
            "drawCallback": function(settings) {}
        });

        $('#filter_pencaker').on('change', function() {
            tabelPencaker.ajax.reload();
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
                        url: '<?= base_url('admin_v2/hapus_pencaker') ?>',
                        type: 'POST',
                        data: {
                            pencakerID: pencakerId
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


        function resetModal() {
            var nopendaftaran = document.getElementById('nopendaftaran');
            var namalengkap = document.getElementById('namalengkap');
            var d_pasfoto = document.getElementById('#d_pasfoto');
            var d_ktp = document.getElementById('#d_ktp');
            var d_ijazah = document.getElementById('d_ijazah');

            if (nopendaftaran) {
                nopendaftaran.value = '';
            }
            if (namalengkap) {
                namalengkap.value = '';
            }
            if (d_pasfoto) {
                d_pasfoto.summernote('code', '');
            }
            if (d_ktp) {
                d_ktp.summernote('code', '');
            }
            if (d_pasfoto) {
                d_pasfoto.value = '';
            }
            if (d_ijazah) {
                d_ijazah.value = '';
            }
        }

        // Verifikasi dan Validasi
        $(document).on('click', '.btn-verval', function() {
            var id = $(this).data('id');
            var namalengkap = $(this).data('namalengkap');
            var nopendaftaran = $(this).data('nopendaftaran');

            // Lakukan sesuatu dengan data yang diambil
            console.log("ID:", id);
            console.log("Nama Lengkap:", namalengkap);
            console.log("Nomor Pendaftaran:", nopendaftaran);

            // Contoh: Isi modal dengan data yang diambil
            $('#VerValModal').find('#usersid').val(id);
            $('#VerValModal').find('#namalengkap').val(namalengkap);
            $('#VerValModal').find('#nopendaftaran').val(nopendaftaran);

            // Tampilkan modal
            $('#VerValModal').modal('show');
        });

        // Hide/Show opsi docs dan pesan verifikasi
        $('#statusverifikasi').change(function() {
            if ($(this).val() == 'ver_tidaklengkap') {
                $('#pesanVerifikasi').removeClass('hide').show();
            } else {
                $('#pesanVerifikasi').addClass('hide').hide();
            }
        });


        $('#saveVerifikasi').click(function() {
            var formData = {
                id: $('#VerValModal #usersid').val(),
                statusverifikasi: $('#VerValModal #statusverifikasi').val(),
                jenis_dokumen: $('input[name="jenis_dokumen[]"]:checked').map(function() {
                    return this.value;
                }).get(),
                pesan: $('#VerValModal #pesan').val(),
                usersid: $('#VerValModal input[name="usersid"]').val()
            };

            $.ajax({
                type: 'POST',
                url: '<?= base_url('admin_v2/saveVerifikasi') ?>',
                data: formData,
                success: function(response) {
                    // Lakukan sesuatu setelah data berhasil disimpan, seperti menutup modal atau me-refresh halaman
                    $('#VerValModal').modal('hide');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Tangani error jika ada
                    console.log(error);
                }
            });
        });
    });
</script>


<?= $this->endSection() ?>