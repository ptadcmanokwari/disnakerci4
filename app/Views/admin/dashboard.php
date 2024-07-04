<!-- app/Views/admin/dashboard.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Load AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('public/adminlte/dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <!-- Add more navbar items as needed -->
            </ul>
        </nav>
        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar content -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <!-- Menu items -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Example menu item -->
                        <li class="nav-item">
                            <a href="<?= base_url('admin/users') ?>" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <!-- Add more content header items as needed -->
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Your content here -->
                    <p>Welcome to the Admin Dashboard!</p>
                </div>
            </section>
        </div>
        <!-- Footer -->
        <footer class="main-footer">
            <!-- Footer content -->
            <div class="float-right d-none d-sm-inline">
                Example footer content
            </div>
        </footer>
    </div>
    <!-- Load AdminLTE JS -->
    <script src="<?= base_url('public/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/adminlte/dist/js/adminlte.min.js') ?>"></script>
</body>

</html>