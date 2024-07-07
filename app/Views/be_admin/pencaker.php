<?= $this->extend('be_admin/layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />

<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="mb-0">Pencari Kerja</h3>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Fixed Layout
                        </li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Title</h3>
                            <div class="card-tools"> <button type="button" class="btn btn-tool"
                                    data-lte-toggle="card-collapse" title="Collapse"> <i data-lte-icon="expand"
                                        class="bi bi-plus-lg"></i> <i data-lte-icon="collapse"
                                        class="bi bi-dash-lg"></i> </button>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                                    <i class="bi bi-x-lg"></i> </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Column 1</th>
                                        <th>Column 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Row 1 Data 1</td>
                                        <td>Row 1 Data 2</td>
                                    </tr>
                                    <tr>
                                        <td>Row 2 Data 1</td>
                                        <td>Row 2 Data 2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">Footer</div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<div class="app-content-bottom-area">
    <div class="row">
        <div class="col-12 text-end"> <button type="submit" class="btn btn-primary" name="save" value="create">Create
                Admin</button> </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>

<?= $this->endSection() ?>