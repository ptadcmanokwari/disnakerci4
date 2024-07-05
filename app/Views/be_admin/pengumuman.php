<?= $this->extend('be_admin/layout') ?>

<?= $this->section('content') ?>

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="mb-0">Pengumuman</h3>
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
                            <p>
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                                eirmod tempor invidunt ut
                                labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                                accusam et justo duo dolores
                                et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
                                ipsum dolor sit amet.
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                                eirmod tempor invidunt ut
                                labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                                accusam et justo duo dolores
                                et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
                                ipsum dolor sit amet.
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                                eirmod tempor invidunt ut
                                labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                                accusam et justo duo dolores
                                et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
                                ipsum dolor sit amet.
                            </p>

                            <p>
                                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper
                                suscipit lobortis nisl ut
                                aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in
                                hendrerit in vulputate velit
                                esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero
                                eros et accumsan et
                                iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis
                                dolore te feugait nulla
                                facilisi.
                            </p>
                            <p>
                                Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet
                                doming id quod mazim
                                placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer
                                adipiscing elit, sed diam
                                nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
                                volutpat. Ut wisi enim ad minim
                                veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                aliquip ex ea commodo
                                consequat.
                            </p>
                            <p>
                                Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse
                                molestie consequat, vel illum
                                dolore eu feugiat nulla facilisis.
                            </p>
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


<?= $this->endSection() ?>