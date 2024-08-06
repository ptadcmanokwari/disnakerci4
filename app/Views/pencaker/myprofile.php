<?= $this->extend('pencaker/template') ?>
<?= $this->section('content') ?>
<style>
    .profile-user-img {
        border: 3px solid #adb5bd;
        margin: 0 !important;
        padding: 5px !important;
        width: 100px;
        height: 100px;
        object-fit: contain;
    }
</style>
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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php if (isset($dokumen) && !empty($dokumen->namadokumen)) : ?>
                                    <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('uploads/dokumen_pencaker/' . user()->nik . '/' . $dokumen->namadokumen); ?>" alt="User profile picture">
                                <?php else : ?>
                                    <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('uploads/dokumen_pencaker/default.webp'); ?>" alt="User profile picture">
                                <?php endif; ?>
                            </div>
                            <h3 class="profile-username text-center"><?php echo user()->namalengkap; ?></h3>
                            <p class="text-muted text-center"><?php echo user()->username; ?></p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>NIK :</b> <a class="float-right"><?php echo user()->nik; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email :</b> <a class="float-right"><?php echo user()->email; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>WhatsApp :</b> <a class="float-right"><?php echo user()->nohp; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Created :</b> <a class="float-right"><?php echo user()->created_at; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Aktivitas Anda</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Ubah Akun</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="card-body">
                                        <div class="timeline">
                                            <?php if (empty($timelines)) : ?>
                                                <div class="text-center">
                                                    <p>Belum ada data untuk ditampilkan</p>
                                                </div>
                                            <?php else : ?>
                                                <?php foreach ($timelines as $timeline) : ?>
                                                    <div class="time-label">
                                                        <span class="bg-info"><?= date('d M. Y', strtotime($timeline['tglwaktu'])) ?></span>
                                                    </div>
                                                    <div>
                                                        <i class="fas fa-envelope bg-info"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock"></i> <?= date('H:i', strtotime($timeline['tglwaktu'])) ?></span>
                                                            <h3 class="timeline-header"><a href="#"><?= esc($timeline['subject']) ?></a></h3>

                                                            <div class="row p-3">
                                                                <div class="col-lg-11">
                                                                    <div class="timeline-body">
                                                                        <?= esc($timeline['description']) ?>
                                                                        <?php if ($id_pencaker['keterangan_status'] == 'Re-Verifikasi' && $timeline['timeline_id'] == 4) : ?>
                                                                            <div class="alert alert-danger mt-3">
                                                                                <?php echo $verifikasiData['pesan']; ?>
                                                                            </div>
                                                                        <?php endif; ?>

                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-1 d-flex justify-content-center align-items-center">
                                                                    <div class="timeline-footer">
                                                                        <i class="bi bi-check-lg text-success"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <div>
                                                <i class="fas fa-clock bg-gray"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
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