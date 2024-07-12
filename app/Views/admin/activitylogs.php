<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Log Activitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Log Activitas</li>
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
                                        <label for="ip_address">IP Address</label>
                                        <input type="text" name="ip_address" id="ip_address" class="form-control" value="" placeholder="Cari IP Address" />
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="user">User</label>
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
                                        <th>IP Address</th>
                                        <th>Email</th>
                                        <th>User Role</th>
                                        <th>Date Time</th>
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
                <table class="table">
                    <tbody>
                        <tr>
                            <th class="font-weight-normal" scope="row">ID:</th>
                            <td class="font-weight-bold" id="id_log"></td>
                        </tr>
                        <tr>
                            <th class="font-weight-normal" scope="row">IP Address:</th>
                            <td class="font-weight-bold" id="ip_address_log"></td>
                        </tr>
                        <tr>
                            <th class="font-weight-normal" scope="row">Title:</th>
                            <td class="font-weight-bold" id="title_log"></td>
                        </tr>
                        <tr>
                            <th class="font-weight-normal" scope="row">User:</th>
                            <td class="font-weight-bold" id="name_log"></td>
                        </tr>
                        <tr>
                            <th class="font-weight-normal" scope="row">Created At:</th>
                            <td class="font-weight-bold" id="created_at_log"></td>
                        </tr>
                    </tbody>
                </table>
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
            url: "<?php echo base_url('admin/getUsers'); ?>",
            type: "GET",
            success: function(data) {
                var users = JSON.parse(data);
                $('#user').select2({
                    data: users
                });
            },
            error: function(xhr, status, error) {
                console.log("AJAX error:", error);
                console.log("Status:", xhr.status);
                console.log("Response:", xhr.responseText);
            }
        });

        $(document).on('click', '.btn-detail-log', function() {
            var id = $(this).data('id');
            var title = $(this).data('title');
            var name = $(this).data('user');
            var created_at = $(this).data('created_at');

            // Set values in modal
            $('#id_log').text(id);
            $('#ip_address_log').text(ip_address);
            $('#title_log').text(title);
            $('#name_log').text(name);
            $('#created_at_log').text(created_at);
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
                "url": "<?php echo base_url('admin/activitylogsajax'); ?>",
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
                    "data": "ip_address"
                },
                {
                    "data": "email"
                },
                {
                    "data": "user_id"
                },
                {
                    "data": "date"
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