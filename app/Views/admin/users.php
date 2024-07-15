<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                            <h3 class="card-title">User List</h3>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserBaruModal">
                                Add New User
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="tabelUsers" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Last Login</th>
                                        <th>Status</th>
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

<!-- Modal Detail User -->
<div class="modal fade" id="detailUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="detailUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailUserModalLabel">Modal Detail User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Detail User</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Log Aktivitas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Ubah User</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            <div class="col-lg-4">
                                <img id="detailUserImage" class="img-fluid rounded" src="" alt="Gambar User">
                            </div>
                            <div class="col-lg-8">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 30%;">ID</th>
                                            <td style="width: 70%;"><span id="detailUserId"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nama</th>
                                            <td><span id="detailUserName"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Username</th>
                                            <td><span id="detailUsername"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td><span id="detailUserEmail"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">No. HP</th>
                                            <td><span id="detailUserPhone"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Role</th>
                                            <td><span id="detailUserRole"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Terakhir Login</th>
                                            <td><span id="detailLogin"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <table id="tabelLogActivity" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>IP Address</th>
                                        <th>Message</th>
                                        <th>Date Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
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
        var tabelUsers = $('#tabelUsers').DataTable({
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
                "url": "<?php echo base_url('usersajax'); ?>",
                "type": "POST"
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "email"
                },
                {
                    "data": "username"
                },
                {
                    "data": "updated_at"
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
                        fetch('<?= base_url('update_status_user') ?>', {
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

        $(document).on('click', '.btn-detail-user', function() {
            var userId = $(this).data('id');
            var userName = $(this).data('name');
            var userUsername = $(this).data('username');
            var userEmail = $(this).data('email');
            var userPhone = $(this).data('phone');
            var userUpdated = $(this).data('updated_at');
            var userRole = $(this).data('role');
            var userImage = $(this).data('gambar');

            // Masukkan data ke dalam modal
            $('#detailUserId').text(userId);
            $('#detailUserName').text(userName);
            $('#detailUsername').text(userUsername);
            $('#detailUserEmail').text(userEmail);
            $('#detailUserPhone').text(userPhone);
            $('#detailLogin').text(userUpdated);
            $('#detailUserRole').text(userRole);

            // Tentukan path gambar berdasarkan kondisi
            var imagePath = '';
            if (userImage) {
                imagePath = '<?php echo base_url('uploads/user/'); ?>' + userImage;
            } else {
                imagePath = '<?php echo base_url('assets/img/default-user-image.png'); ?>';
            }

            // Tampilkan gambar user
            $('#detailUserImage').attr('src', imagePath);
        });


        $('#tabelUsers').on('click', '.btn-delete', function() {
            var userId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus user ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('hapus_user') ?>',
                        type: 'POST',
                        data: {
                            user_id: userId // Sesuaikan dengan nama yang digunakan di controller
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                tabelUsers.ajax.reload();
                                Swal.fire(
                                    'Sukses!',
                                    'User berhasil dihapus.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus user.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus user.',
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