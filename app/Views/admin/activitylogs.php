<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Log Aktivitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php site_url(); ?>dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Log Aktivitas</li>
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
                            <h3 class="card-title">Tabel Log Aktivitas Pengguna</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="user">Filter by:</label>
                                        <select name="user" id="user" class="form-control select2">
                                            <option value="">- Pilih User -</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <table id="tabelLogActivity" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th class="w-50">Title</th>
                                        <th>User</th>
                                        <th>IP Address</th>
                                        <th>Last Login</th>
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

<!-- Detail Log -->
<div class="modal fade" id="detailLogModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="detailLogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailLogModalLabel">Detail Log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>ID</span>
                            </div>
                            <div class="col-md-9">
                                : <strong id="detailUserId"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Nama</span>
                            </div>
                            <div class="col-md-9">
                                : <strong id="detailUserName"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>NIK</span>
                            </div>
                            <div class="col-md-9">
                                : <strong id="detailUserNIK"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Username</span>
                            </div>
                            <div class="col-md-9">
                                : <strong id="detailUsername"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Email</span>
                            </div>
                            <div class="col-md-9">
                                : <strong id="detailUserEmail"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>No. HP</span>
                            </div>
                            <div class="col-md-9">
                                : <strong id="detailUserPhone"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Role</span>
                            </div>
                            <div class="col-md-9">
                                : <strong id="detailUserRole"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Terakhir Login</span>
                            </div>
                            <div class="col-md-9">
                                : <strong id="detailLogin"></strong>
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
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();

        $.ajax({
            url: "<?php echo base_url('admin_v2/getUsersFromLogs'); ?>",
            type: "GET",
            success: function(data) {
                if (data.length === 0) {
                    $('#user').html('<option value="">Belum ada data user</option>');
                } else {
                    $('#user').empty().append('<option value="">- Pilih User -</option>');
                    $.each(data, function(index, user) {
                        $('#user').append(new Option(user.text, user.id));
                    });
                    $('#user').select2();
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX error:", error);
                console.log("Status:", xhr.status);
                console.log("Response:", xhr.responseText);
            }
        });

        $(document).on('click', '.btn-detail-log', function() {
            var userId = $(this).data('userid');
            var userNIK = $(this).data('nik');
            var userName = $(this).data('namalengkap');
            var userUsername = $(this).data('username');
            var userEmail = $(this).data('email');
            var userPhone = $(this).data('nohp');
            var userUpdated = $(this).data('updated_at');
            var userRole = $(this).data('name');

            // Masukkan data ke dalam modal
            $('#detailUserId').text(userId);
            $('#detailUserNIK').text(userNIK);
            $('#detailUserName').text(userName);
            $('#detailUsername').text(userUsername);
            $('#detailUserEmail').text(userEmail);
            $('#detailUserPhone').text(userPhone);
            $('#detailLogin').text(userUpdated);
            $('#detailUserRole').text(userRole);
        });

        var tabelLogActivity = $('#tabelLogActivity').DataTable({
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
                "url": "<?php echo base_url('admin_v2/activitylogsajax'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.ip_address = $('#ip_address').val();
                    d.user = $('#user').val();
                },
                "error": function(xhr, error, thrown) {
                    console.log("AJAX error:", error);
                    console.log("Status:", xhr.status);
                    console.log("Response:", xhr.responseText);
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "title"
                },
                {
                    "data": "user"
                },
                {
                    "data": "ip_address"
                },
                {
                    "data": "updated_at"
                },
                {
                    "data": "aksi"
                }
            ],
            "drawCallback": function(settings) {}
        });

        $('#ip_address, #user').on('change', function() {
            tabelLogActivity.ajax.reload();
        });
    });
</script>

<?= $this->endSection() ?>