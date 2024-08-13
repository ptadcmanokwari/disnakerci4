<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?> - Panel Admin</title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>frontend/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>frontend/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>frontend/assets/img/favicon/favicon-16x16.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/fontawesome-free/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/select2-bootstrap4-theme/select2-bootstrap4.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/select2/css/select2.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('adminltev31/dist/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/summernote/summernote-bs4.min.css'); ?>">
    <style>
        ul.nav.nav-treeview a.nav-link {
            padding-left: 35px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header:after {
            display: none;
        }

        .table td,
        .table th {
            vertical-align: middle !important;
        }

        .btn.btn-info,
        .btn.btn-warning,
        .btn.btn-danger,
        .btn.btn-success,
        .btn.btn-secondary,
        .btn.btn-primary {
            border-radius: 5px !important;
            margin: 2px !important;
        }

        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: normal;
        }

        /* Verifikasi modal verifikasi pencaker halaman pencaker admin */
        .hide {
            display: none;
        }

        /* Select2 Activity Logs */
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
        }

        /* Detail User Modal */
        div#detailUserModal .nav-pills .nav-link.active,
        div#detailUserModal .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #007bff;
            border: 0 !important;
        }

        div#detailUserModal .nav-pills .nav-link {
            color: #6c757d;
            border: 0;
            background-color: transparent;
        }

        /* Kolom Aksi tabel Pencaker */
        table.table-bordered.dataTable th:last-child,
        table.table-bordered.dataTable td:last-child {
            text-align: center;
            width: 20px;
        }

        /* Icon bagian card dashboard */
        .small-box .icon>i {
            font-size: 60px;
        }

        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: normal !important;
        }

        #profilPencaker .card-header.with-border h3 {
            font-weight: bold !important;
        }

        a.disabled:hover {
            cursor: not-allowed !important;
        }

        .disabled-link {
            pointer-events: none;
            opacity: 0.5;
        }

        /* Dropzone */
        .dz-preview.dz-image-preview {
            display: none;
        }

        .dz-started.dz-max-files-reached {
            display: none;
        }

        .dropzone {
            color: #000 !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('/') ?>" target="_blank">
                        <i class="bi bi-globe"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="dark-mode-toggle">
                        <i class="bi bi-moon-stars-fill"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <span><strong>Hi, <?php echo user()->username; ?></strong></span>
                    </a>
                </li>
                <button class="btn-sm btn btn-danger text-white p-2 m-0" id="logoutButton">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-info elevation-4">
            <?php if (in_groups('administrator')) : ?>
                <a href="<?php echo base_url('admin_v2/dashboard'); ?>" class="brand-link">
                    <img src="<?= base_url(); ?>frontend/assets/img/favicon/favicon-32x32.png" alt="Logo Pemkab" class="brand-image elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light font-weight-bold">PANEL ADMIN</span>
                </a>
            <?php elseif (in_groups('pencaker')) : ?>
                <a href="<?php echo base_url('pencaker/dashboard'); ?>" class="brand-link">
                    <img src="<?= base_url(); ?>frontend/assets/img/favicon/favicon-32x32.png" alt="Logo Pemkab" class="brand-image elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light font-weight-bold">PANEL PENCAKER</span>
                </a>
            <?php endif; ?>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php if (in_groups('administrator')) : ?>
                            <li class="nav-item">
                                <a href="<?= base_url('admin_v2/dashboard'); ?>" class="nav-link <?= ($current_uri == 'dashboard') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-speedometer2"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('admin_v2/pencaker'); ?>" class="nav-link <?= ($current_uri == 'pencaker') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-people"></i>
                                    <p>Pencaker</p>
                                </a>
                            </li>
                            <li class="nav-item <?= ($current_uri == 'berita' || $current_uri == 'pengumuman' || $current_uri == 'pelatihan' || $current_uri == 'slider') ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= ($current_uri == 'berita' || $current_uri == 'pengumuman' || $current_uri == 'pelatihan' || $current_uri == 'slider') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-info-circle-fill"></i>
                                    <p>
                                        Informasi Web
                                        <i class="bi bi-chevron-right right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item ">
                                        <a href="<?= base_url('admin_v2/berita'); ?>" class="nav-link <?= ($current_uri == 'berita') ? 'active' : '' ?>">
                                            <i class="bi bi-circle nav-icon"></i>
                                            <p>Berita</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('admin_v2/pengumuman'); ?>" class="nav-link <?= ($current_uri == 'pengumuman') ? 'active' : '' ?>">
                                            <i class="bi bi-circle nav-icon"></i>
                                            <p>Pengumuman</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('admin_v2/pelatihan'); ?>" class="nav-link <?= ($current_uri == 'pelatihan') ? 'active' : '' ?>">
                                            <i class="bi bi-circle nav-icon"></i>
                                            <p>Pelatihan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url('admin_v2/slider'); ?>" class="nav-link <?= ($current_uri == 'slider') ? 'active' : '' ?>">
                                            <i class="bi bi-circle nav-icon"></i>
                                            <p>Sliders</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin_v2/activitylogs'); ?>" class="nav-link <?= ($current_uri == 'activitylogs') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-clock-history"></i>
                                    <p>Aktivitas Pengguna</p>
                                </a>
                            </li>
                            <li class="nav-header my-1 text-muted">SUPER ADMIN</li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('admin_v2/users'); ?>" class="nav-link <?= ($current_uri == 'users') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-person-fill-gear"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('admin_v2/settings'); ?>" class="nav-link <?= ($current_uri == 'settings') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-gear"></i>
                                    <p>Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('admin_v2/backup'); ?>" class="nav-link <?= ($current_uri == 'backup') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-database"></i>
                                    <p>Backup</p>
                                </a>
                            </li>
                        <?php elseif (in_groups('pencaker')) : ?>
                            <li class="nav-item">
                                <a href="<?php echo base_url('pencaker/dashboard'); ?>" class="nav-link <?= ($current_uri == 'dashboard') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-speedometer2"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('pencaker/profil_pencaker'); ?>" class="nav-link <?= ($current_uri == 'profil_pencaker') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-person-badge"></i>
                                    <p>Profil Pencari Kerja</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('pencaker/dokumen_pencaker'); ?>" class="nav-link <?= ($current_uri == 'dokumen_pencaker') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-file-earmark-arrow-up-fill"></i>
                                    <p>Upload Dokumen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('pencaker/pengaturan'); ?>" class="nav-link <?= ($current_uri == 'pengaturan') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-gear"></i>
                                    <p>Pengaturan</p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </aside>

        <?= $this->renderSection('content') ?>

        <footer class="main-footer">
            <strong>Copyright &copy; 2024
                <a class="text-decoration-none" href="https://disnakertransmkw.com">Dinas Ketenagakerjaan dan
                    Transmigrasi Kab. Manokwari
                </a>.
            </strong> All rights reserved.
        </footer>
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    <script src="<?php echo base_url('adminltev31/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/jszip/jszip.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/pdfmake/pdfmake.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/pdfmake/vfs_fonts.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/dist/js/pages/dashboard.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/select2/js/select2.js'); ?>"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="<?php echo base_url('adminltev31/dist/js/adminlte.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/dist/js/demo.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk mode gelap dan terang
            function setMode(mode) {
                if (mode === 'dark') {
                    $('body').addClass('dark-mode');
                    $('#mode-icon').removeClass('bi-sun-fill').addClass('bi-moon-stars-fill');
                    $('#mode-switch').prop('checked', true).change();
                    $('#navbar').removeClass('navbar-white navbar-light').addClass('navbar-dark navbar-dark');
                } else {
                    $('body').removeClass('dark-mode');
                    $('#mode-icon').removeClass('bi-moon-stars-fill').addClass('bi-sun-fill');
                    $('#mode-switch').prop('checked', false).change();
                    $('#navbar').removeClass('navbar-dark navbar-dark').addClass('navbar-white navbar-light');
                }
                localStorage.setItem('mode', mode);
            }

            // Set mode berdasarkan nilai yang disimpan di localStorage
            var savedMode = localStorage.getItem('mode');
            setMode(savedMode ? savedMode : 'light');

            // Event handler untuk switch mode
            $('#mode-switch').change(function() {
                var mode = $(this).prop('checked') ? 'dark' : 'light';
                setMode(mode);
            });

            // Event handler untuk toggle mode
            $('#dark-mode-toggle').on('click', function(e) {
                e.preventDefault();
                var currentMode = $('body').hasClass('dark-mode') ? 'dark' : 'light';
                setMode(currentMode === 'dark' ? 'light' : 'dark');
            });

            // Event handler untuk logout dengan konfirmasi
            document.getElementById('logoutButton').addEventListener('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan keluar dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, logout!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "<?php echo base_url('logout'); ?>";
                    }
                });
            });
        });
    </script>
</body>

</html>