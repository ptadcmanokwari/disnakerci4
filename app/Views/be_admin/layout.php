<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AdminLTE 4 | Fixed Complete</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE 4 | Fixed Complete">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard">
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous">
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/styles/overlayscrollbars.min.css" integrity="sha256-dSokZseQNT08wYEWiz5iLI8QPlKxG+TswNRD8k35cpg=" crossorigin="anonymous">
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css" integrity="sha256-Qsx5lrStHZyR9REqhUF8iQt73X06c8LGIUPzpOhwRrI=" crossorigin="anonymous">
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url(); ?>adminlte/dist/css/adminlte.css">

    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!--end::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous">

    <script src="<?= base_url('frontend/jquery/jquery.min.js') ?>"></script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed-complete sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link--> <a href="<?= base_url('admin'); ?>" class="brand-link">
                    <!--begin::Brand Image--> <img src="<?= base_url(); ?>adminlte/dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
                    <!--end::Brand Image-->
                    <!--begin::Brand Text--> <span class="brand-text fw-light">PANEL ADMIN</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
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
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <div class="app-main-wrapper">
            <!--begin::Header-->
            <nav class="app-header navbar navbar-expand bg-body">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Start Navbar Links-->
                    <ul class="navbar-nav">
                        <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                        <!-- <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
                        <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li> -->
                    </ul>
                    <!--end::Start Navbar Links-->
                    <!--begin::End Navbar Links-->
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i>
                            </a> </li>
                        <!--end::Fullscreen Toggle-->
                        <!--begin::User Menu Dropdown-->
                        <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="<?= base_url(); ?>adminlte/dist/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline">Alexander Pierce</span> </a>
                            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <!--begin::User Image-->
                                <li class="user-header text-bg-primary"> <img src="<?= base_url(); ?>adminlte/dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">
                                    <p>
                                        Alexander Pierce - Web Developer
                                        <small>Member since Nov. 2023</small>
                                    </p>
                                </li>
                                <!--end::User Image-->
                                <!--begin::Menu Body-->
                                <li class="user-body">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <div class="col-4 text-center"> <a href="#">Followers</a> </div>
                                        <div class="col-4 text-center"> <a href="#">Sales</a> </div>
                                        <div class="col-4 text-center"> <a href="#">Friends</a> </div>
                                    </div>
                                    <!--end::Row-->
                                </li>
                                <!--end::Menu Body-->
                                <!--begin::Menu Footer-->
                                <li class="user-footer"> <a href="#" class="btn btn-default btn-flat">Profile</a> <a href="#" class="btn btn-default btn-flat float-end">Sign out</a> </li>
                                <!--end::Menu Footer-->
                            </ul>
                        </li>
                        <!--end::User Menu Dropdown-->
                    </ul>
                    <!--end::End Navbar Links-->
                </div>
                <!--end::Container-->
            </nav>
            <!--end::Header-->
            <!--begin::App Main-->


            <?= $this->renderSection('content') ?>

            <!--end::App Main-->
            <!--begin::Footer-->
            <footer class="app-footer">
                <!--begin::To the end-->
                <!-- <div class="float-end d-none d-sm-inline">Anything you want</div> -->
                <!--end::To the end-->
                <!--begin::Copyright--> <strong>
                    Copyright &copy; 2024&nbsp;
                    <a href="https://disnakertransmkw.com" class="text-decoration-none">Dinas Ketenagakerjaan dan
                        Transmigrasi Kab. Manokwari</a>.
                </strong>
                All rights reserved.
                <!--end::Copyright-->
            </footer>
            <!--end::Footer-->
        </div>
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.3.0/browser/overlayscrollbars.browser.es6.min.js" integrity="sha256-H2VM7BKda+v2Z4+DRy69uknwxjyDRhszjXFhsL4gD3w=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    <!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha256-YMa+wAM6QkVyz999odX7lPRxkoYAan8suedu4k2Zur8=" crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="<?= base_url(); ?>adminlte/dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
        const Default = {
            scrollbarTheme: "os-theme-light",
            scrollbarAutoHide: "leave",
            scrollbarClickScroll: true,
        };
        document.addEventListener("DOMContentLoaded", function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (
                sidebarWrapper &&
                typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
</body>
<!--end::Body-->

</html>