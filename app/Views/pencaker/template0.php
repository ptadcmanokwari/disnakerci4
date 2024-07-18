<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?> - Panel Admin</title>

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
            padding-left: 40px;
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
        .btn.btn-success {
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

        #profilPencaker .card {
            box-shadow: none !important;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url(); ?>index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?php echo base_url(); ?>dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?php echo base_url(); ?>dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="<?php echo base_url(); ?>dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo base_url('pencaker/dashboard'); ?>" class="brand-link">
                <img src="<?php echo base_url(); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">PANEL ADMIN</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo base_url('pencaker/dashboard'); ?>" class="nav-link <?= ($current_uri == 'dashboard') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-database"></i>
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
                            <a href="<?php echo base_url('pencaker/form'); ?>" class="nav-link <?= ($current_uri == 'form') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>Upload Dokumen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('pencaker/settings'); ?>" class="nav-link <?= ($current_uri == 'settings') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-gear"></i>
                                <p>Pengaturan Profil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('logout'); ?>" class="nav-link <?= ($current_uri == 'logout') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p>Logout</p>
                            </a>
                        </li>

                        <!-- Menu untuk pencaker -->
                        <li class="nav-item">
                            <a href="<?php echo base_url('pencaker/profil_pencaker'); ?>" class="nav-link <?= ($current_uri == 'profil_pencaker') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>Profil Pencari Kerja</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('pencaker/form'); ?>" class="nav-link <?= ($current_uri == 'form') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>Form</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('logout'); ?>" class="nav-link <?= ($current_uri == 'logout') ? 'active' : '' ?>">
                                <i class="nav-icon bi bi-box-arrow-right"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- /.sidebar -->
        </aside>

        <?= $this->renderSection('content') ?>

        <footer class="main-footer">
            <strong>Copyright &copy; 2024
                <a class="text-decoration-none" href="https://disnakertransmkw.com">Dinas Ketenagakerjaan dan
                    Transmigrasi Kab. Manokwari
                </a>.
            </strong> All rights reserved.
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?php echo base_url('adminltev31/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('adminltev31/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?php echo base_url('adminltev31/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>">
    </script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>">
    </script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>">
    </script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>">
    </script>
    <script src="<?php echo base_url('adminltev31/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>">
    </script>
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

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });

        });
    </script>
    <!--  -->
</body>

</html>