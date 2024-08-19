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
                        <li class="breadcrumb-item"><a href="<?php site_url(); ?>dashboard">Dashboard</a></li>
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
                            <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addUserBaruModal">
                                Add New User
                            </button> -->
                        </div>
                        <div class="card-body">
                            <table id="tabelUsers" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Last Login</th>
                                        <th>Role</th>
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
                <div class="row">
                    <div class="col-lg-4 d-flex justify-content-center align-items-center">
                        <img id="detailUserImage" class="img-fluid rounded w-75" src="" alt="Gambar User">
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
                                <span>Nama</span>
                            </div>
                            <div class="col-md-9">
                                <strong id="detailUserName"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>NIK</span>
                            </div>
                            <div class="col-md-9">
                                <strong id="detailUserNIK"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Username</span>
                            </div>
                            <div class="col-md-9">
                                <strong id="detailUsername"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Email</span>
                            </div>
                            <div class="col-md-9">
                                <strong id="detailUserEmail"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>No. HP</span>
                            </div>
                            <div class="col-md-9">
                                <strong id="detailUserPhone"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Role</span>
                            </div>
                            <div class="col-md-9">
                                <strong id="detailUserRole"></strong>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-3">
                                <span>Terakhir Login</span>
                            </div>
                            <div class="col-md-9">
                                <strong id="detailLogin"></strong>
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

<!-- Modal Ubah Role User -->
<div class="modal fade" id="ubahUserModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ubahUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="updateRoleForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahUserModalLabel">Modal Ubah Role User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="userId">
                    <div class="mb-3">
                        <span>Ubah Role User ini?</span>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roles" id="role1" value="1">
                        <label class="form-check-label" for="role1">
                            Administrator
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="roles" id="role2" value="2">
                        <label class="form-check-label" for="role2">
                            Pencaker
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-save-changes">Simpan Perubahan</button>
                </div>
            </form>
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
                "url": "<?php echo base_url('admin_v2/usersajax'); ?>",
                "type": "POST"
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "namalengkap"
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
                    "data": "name"
                },
                {
                    "data": "active",
                    "className": "text-center"
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
                        var active = this.checked ? 1 : 0;
                        var id = this.getAttribute('data-id');

                        // Kirim AJAX request untuk memperbarui status di server
                        fetch('<?= base_url('admin_v2/update_status_user') ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                                },
                                body: JSON.stringify({
                                    id: id,
                                    active: active
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
            var userNIK = $(this).data('nik');
            var userName = $(this).data('namalengkap');
            var userUsername = $(this).data('username');
            var userEmail = $(this).data('email');
            var userPhone = $(this).data('nohp');
            var userUpdated = $(this).data('updated_at');
            var userRole = $(this).data('name');
            var userImage = $(this).data('gambar');

            // Masukkan data ke dalam modal
            $('#detailUserId').text(userId);
            $('#detailUserNIK').text(userNIK);
            $('#detailUserName').text(userName);
            $('#detailUsername').text(userUsername);
            $('#detailUserEmail').text(userEmail);
            $('#detailUserPhone').text(userPhone);
            $('#detailLogin').text(userUpdated);
            $('#detailUserRole').text(userRole);

            // Tampilkan gambar user
            $('#detailUserImage').attr('src', userImage);
        });

        $(document).on('click', '.btn-edit', function() {
            var userId = $(this).data('id');
            var groupId = $(this).data('group_id');

            // Set value of user_id input
            $('#userId').val(userId);

            // Set value of radio buttons based on group_id
            if (groupId == 1) {
                $('#role1').prop('checked', true);
            } else if (groupId == 2) {
                $('#role2').prop('checked', true);
            }

            // You can also load other data into the modal if needed
            $('#ubahUserModal').modal('show');
        });

        $('#updateRoleForm').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin akan mengubah role user ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formData = $(this).serialize();

                    $.ajax({
                        url: '<?= base_url('admin_v2/ubah_role_user') ?>',
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Role user berhasil diubah.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    // Reload DataTables
                                    $('#tabelUsers').DataTable().ajax.reload();
                                    $('#ubahUserModal').modal('hide');
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Terjadi kesalahan saat mengubah role user.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                }
            });
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