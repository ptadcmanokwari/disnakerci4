<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dinas Tenaga Kerja</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php base_url(); ?>adminltev31/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php base_url(); ?>adminltev31/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?php base_url(); ?>adminltev31/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?php base_url(); ?>adminltev31/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?php base_url(); ?>adminltev31/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php base_url(); ?>adminltev31/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?php base_url(); ?>adminltev31/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?php base_url(); ?>adminltev31/plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="app-wrapper">
            <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
                <div class="sidebar-brand">
                    <a href="<?= base_url('admin'); ?>" class="brand-link">
                        <img src="<?= base_url(); ?>adminltev31/dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">

                        <span class="brand-text fw-light">PANEL ADMIN</span>
                    </a>
                </div>
                <div class="sidebar-wrapper">
                    <nav class="mt-2">
                        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                            <li class="nav-item"> <a href="<?= base_url('admin/dashboard'); ?>" class="nav-link <?= ($current_uri == 'dashboard') ? 'active' : '' ?>"> <i class="nav-icon bi bi-laptop"></i>
                                    <p>Dashboard</p>
                                </a> </li>
                            <li class="nav-item"> <a href="<?= base_url('admin/pencaker'); ?>" class="nav-link <?= ($current_uri == 'pencaker') ? 'active' : '' ?>"> <i class="nav-icon bi bi-people-fill"></i>
                                    <p>Pencaker</p>
                                </a> </li>
                            <li class="nav-item <?= ($current_uri == 'berita' || $current_uri == 'pengumuman' || $current_uri == 'pelatihan') ? 'menu-open' : '' ?>">
                                <a href="#" class="nav-link <?= ($current_uri == 'berita' || $current_uri == 'pengumuman' || $current_uri == 'pelatihan') ? 'active' : '' ?>">
                                    <i class="nav-icon bi bi-info-circle-fill"></i>
                                    <p>
                                        Informasi Web
                                        <i class="nav-arrow bi bi-chevron-right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item"> <a href="<?= base_url('admin/berita'); ?>" class="nav-link <?= ($current_uri == 'berita') ? 'active' : '' ?>"> <i class="nav-icon bi bi-circle"></i>
                                            <p>Berita</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="<?= base_url('admin/pengumuman'); ?>" class="nav-link <?= ($current_uri == 'pengumuman') ? 'active' : '' ?>">
                                            <i class="nav-icon bi bi-circle"></i>
                                            <p>Pengumuman</p>
                                        </a> </li>
                                    <li class="nav-item"> <a href="<?= base_url('admin/pelatihan'); ?>" class="nav-link <?= ($current_uri == 'pelatihan') ? 'active' : '' ?>"> <i class="nav-icon bi bi-circle"></i>
                                            <p>Pelatihan</p>
                                        </a> </li>
                                </ul>
                            </li>
                            <li class="nav-item"> <a href="<?= base_url('admin/userslog'); ?>" class="nav-link <?= ($current_uri == 'userslog') ? 'active' : '' ?>"> <i class="nav-icon bi bi-clock-history"></i>
                                    <p>Aktivitas Pengguna</p>
                                </a> </li>
                            <li class="nav-header">SUPER ADMIN</li>

                            <li class="nav-item"> <a href="<?= base_url('admin/users'); ?>" class="nav-link <?= ($current_uri == 'users') ? 'active' : '' ?>"> <i class="nav-icon bi bi-person-fill-gear"></i>
                                    <p>Users</p>
                                </a> </li>

                            <li class="nav-item"> <a href="<?= base_url('admin/settings'); ?>" class="nav-link <?= ($current_uri == 'settings') ? 'active' : '' ?>"> <i class="nav-icon bi bi-gear"></i>
                                    <p>Settings</p>
                                </a> </li>

                            <li class="nav-item"> <a href="<?= base_url('admin/backup'); ?>" class="nav-link <?= ($current_uri == 'backup') ? 'active' : '' ?>"> <i class="nav-icon bi bi-database-fill-down"></i>
                                    <p>Backup</p>
                                </a> </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="app-main-wrapper">
                <nav class="app-header navbar navbar-expand bg-body">
                    <div class="container-fluid">
                        <ul class="navbar-nav">
                            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                                </a> </li>
                            <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="<?= base_url(); ?>adminltev31/dist/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline">Alexander Pierce</span> </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                    <li class="user-header text-bg-primary"> <img src="<?= base_url(); ?>adminltev31/dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">
                                        <p>
                                            Alexander Pierce - Web Developer
                                            <small>Member since Nov. 2023</small>
                                        </p>
                                    </li>
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-4 text-center"> <a href="#">Followers</a> </div>
                                            <div class="col-4 text-center"> <a href="#">Sales</a> </div>
                                            <div class="col-4 text-center"> <a href="#">Friends</a> </div>
                                        </div>
                                    </li>
                                    <li class="user-footer"> <a href="#" class="btn btn-default btn-flat">Profile</a> <a href="#" class="btn btn-default btn-flat float-end">Sign out</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

                <?= $this->renderSection('content') ?>

                <footer class="app-footer">
                    <strong> Copyright &copy; 2024&nbsp;
                        <a href="https://disnakertransmkw.com" class="text-decoration-none">Dinas Ketenagakerjaan dan
                            Transmigrasi Kab. Manokwari</a>.
                    </strong> All rights reserved.
                </footer>
            </div>
        </div>
        <script src="<?php base_url(); ?>adminltev31/plugins/jquery/jquery.min.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <script src="<?php base_url(); ?>adminltev31/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/chart.js/Chart.min.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/sparklines/sparkline.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/jquery-knob/jquery.knob.min.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/moment/moment.min.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="<?php base_url(); ?>adminltev31/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="<?php base_url(); ?>adminltev31/dist/js/adminlte.js"></script>
        <script src="<?php base_url(); ?>adminltev31/dist/js/demo.js"></script>
        <script src="<?php base_url(); ?>adminltev31/dist/js/pages/dashboard.js"></script>
</body>

</html>