<?= $this->extend('be_admin/layout') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
    table.dataTable {
        width: 100%;
        margin: 13px auto;
        border-collapse: collapse;
    }

    div#newsTable_length {
        margin-bottom: 10px;
    }
</style>
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="mb-0">Berita</h3>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fixed Layout</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Daftar Berita</h3>
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary" name="save" value="create">Tambah Berita Baru</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="newsTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="w-5">No.</th>
                                        <th class="w-25">Judul Berita</th>
                                        <th class="w-20">Kategori</th>
                                        <th class="w-50">Isi Berita</th>
                                        <th class="w-10">Gambar</th>
                                        <th class="w-5">Aksi</th>
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
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#newsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('admin/berita_ajax') ?>',
                type: 'POST'
            },
            columns: [{
                    data: null
                },
                {
                    data: 'judul'
                },
                {
                    data: 'kategori'
                },
                {
                    data: 'isi'
                },
                {
                    data: 'gambar',
                    render: function(data) {
                        return `<img src="<?= base_url('uploads/berita/') ?>${data}" class="img-thumbnail" width="100">`;
                    }
                },
                {
                    data: 'id',
                    render: function(data) {
                        return `<button class="btn btn-secondary btn-sm delete-berita" data-id="${data}">Hapus</button>`;
                    }
                }
            ],
            columnDefs: [{
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            }]
        });
    });
</script>

<?= $this->endSection() ?>