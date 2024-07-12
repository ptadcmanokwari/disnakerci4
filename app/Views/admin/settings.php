<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengaturan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengaturan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section id="pengaturan" class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pengaturan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-5 col-sm-3">
                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="pengaturanUmum-tab" data-toggle="pill" href="#pengaturanUmum" role="tab" aria-controls="pengaturanUmum" aria-selected="true">Pengaturan Umum</a>
                                        <a class="nav-link" id="pengaturanFrontend-tab" data-toggle="pill" href="#pengaturanFrontend" role="tab" aria-controls="pengaturanFrontend" aria-selected="false">Pengaturan Frontend</a>
                                        <a class="nav-link" id="pengaturanEmail-tab" data-toggle="pill" href="#pengaturanEmail" role="tab" aria-controls="pengaturanEmail" aria-selected="false">Pengaturan Email</a>

                                    </div>
                                </div>
                                <div class="col-lg-9 col-7 col-sm-9">
                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade show active" id="pengaturanUmum" role="tabpanel" aria-labelledby="pengaturanUmum-tab">

                                        </div>

                                        <div class="tab-pane fade" id="pengaturanFrontend" role="tabpanel" aria-labelledby="pengaturanFrontend-tab">

                                        </div>

                                        <div class="tab-pane fade" id="pengaturanEmail" role="tabpanel" aria-labelledby="pengaturanEmail-tab">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>