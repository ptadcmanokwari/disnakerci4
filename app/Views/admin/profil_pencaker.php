<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/fontawesome-free/css/all.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/daterangepicker/daterangepicker.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/select2/css/select2.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/bs-stepper/css/bs-stepper.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/dropzone/min/dropzone.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/dist/css/adminlte.min.css'); ?>">

<style>
    .nav-tabs.flex-column .nav-item.show .nav-link,
    .nav-tabs.flex-column .nav-link.active {
        border-color: #dee2e6 transparent #dee2e6 #dee2e6;
        background-color: #007bff;
        color: #fff;
    }

    #profilPencaker a.nav-link {
        border: 1px solid #dee2e6 !important;
        margin: 0 0 10px 0;
        display: flex;
        align-items: center;
    }

    #profilPencaker a i {
        font-size: 20px;
        margin-right: 10px;
    }

    #profilPencaker .nav-tabs.flex-column {
        border: 0 !important;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil Pencari Kerja</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Profil Pencari Kerja</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section id="profilPencaker" class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Profil Pencari Kerja</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-5 col-sm-3">
                                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="tujuanPencaker-tab" data-toggle="pill" href="#tujuanPencaker" role="tab" aria-controls="tujuanPencaker" aria-selected="true"><i class="bi bi-question-circle-fill"></i> Tujuan</a>
                                        <a class="nav-link" id="keteranganUmum-tab" data-toggle="pill" href="#keteranganUmum" role="tab" aria-controls="keteranganUmum" aria-selected="false"><i class="bi bi-person-vcard-fill"></i> Keterangan Umum</a>
                                        <a class="nav-link" id="pendidikanFormal-tab" data-toggle="pill" href="#pendidikanFormal" role="tab" aria-controls="pendidikanFormal" aria-selected="false"><i class="bi bi-mortarboard-fill"></i> Pendidikan Formal</a>
                                        <a class="nav-link" id="keterampilanBahasa-tab" data-toggle="pill" href="#keterampilanBahasa" role="tab" aria-controls="keterampilanBahasa" aria-selected="false"><i class="bi bi-translate"></i> Keterampilan Bahasa</a>
                                        <a class="nav-link" id="pengalamanKerja-tab" data-toggle="pill" href="#pengalamanKerja" role="tab" aria-controls="pengalamanKerja" aria-selected="false"><i class="bi bi-building-fill-check"></i> Pengalaman Kerja</a>
                                        <a class="nav-link" id="bidangPekerjaan-tab" data-toggle="pill" href="#bidangPekerjaan" role="tab" aria-controls="bidangPekerjaan" aria-selected="false"><i class="bi bi-person-workspace"></i> Bidang Pekerjaan yang Diminati</a>
                                        <a class="nav-link" id="perusahaanTujuan-tab" data-toggle="pill" href="#perusahaanTujuan" role="tab" aria-controls="perusahaanTujuan" aria-selected="false"><i class="bi bi-building-add"></i> Perusahaan/Instansi yang Dituju</a>
                                        <a class="nav-link" id="keteranganTambahan-tab" data-toggle="pill" href="#keteranganTambahan" role="tab" aria-controls="keteranganTambahan" aria-selected="false"><i class="bi bi-plus-circle-fill"></i> Keterangan Tambahan</a>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-7 col-sm-9">
                                    <div class="tab-content" id="vert-tabs-tabContent">
                                        <div class="tab-pane text-left fade show active" id="tujuanPencaker" role="tabpanel" aria-labelledby="tujuanPencaker-tab">
                                            <div class="card tujuanpencaker">
                                                <div class="card-header with-border">
                                                    <h3 class="card-title">Tujuan Pembuatan Kartu Pencaker</h3>
                                                </div>
                                                <form action="#" id="formtujuanpencaker">
                                                    <div class="card-body">
                                                        <div class="form-card">
                                                            <div class="alert alert-success" role="alert">
                                                                Silakan pilih tujuan Anda membuat Kartu Kuning!
                                                            </div>
                                                            <div class="row mt-3" id="pilihTujuan">
                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3">
                                                                    <label for="">Pilih Tujuan Anda</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="tujuan" id="tujuan1" value="tujuan1">
                                                                        <label class="form-check-label" for="tujuan1">
                                                                            Mencari Pekerjaan
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="tujuan" id="tujuan2" value="tujuan2">
                                                                        <label class="form-check-label" for="tujuan2">
                                                                            Melengkapi Persyaratan Melamar Pekerjaan
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="button" id="btnSave1" class="btn btn-flat btn-primary"><?php echo lang('selanjutnya') ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="keteranganUmum" role="tabpanel" aria-labelledby="keteranganUmum-tab">
                                            <div class="card identitaspencaker">
                                                <div class="card-header with-border">
                                                    <h3 class="card-title">Keterangan Umum Identitas Pencaker</h3>
                                                </div>
                                                <form action="#" id="formidentitaspencaker">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="form-card">
                                                                    <div class="alert alert-success" role="alert">
                                                                        Lengkapi data diri Anda di bawah ini!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="nopendaftaran">Nomor Pendaftaran</label>
                                                                    <input type="text" class="form-control" name="nopendaftaran" id="nopendaftaran" readonly />
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="nik">NIK</label>
                                                                    <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="namalengkap">Nama Lengkap</label>
                                                                    <input type="text" class="form-control" name="namalengkap" id="namalengkap" required placeholder="Nama Sesuai KTP" autofocus />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="jenkel">Jenis Kelamin</label>
                                                                    <div class="row">
                                                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="jenkel" id="jenkel1" value="L">
                                                                                <label class="form-check-label" for="jenkel1">
                                                                                    Laki-laki
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="radio" name="jenkel" id="jenkel2" value="P">
                                                                                <label class="form-check-label" for="jenkel2">
                                                                                    Perempuan
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="tempatlahir">Tempat Lahir</label>
                                                                    <input type="text" class="form-control" name="tempatlahir" id="tempatlahir" placeholder="Tempat Lahir Sesuai KTP" required placeholder="Nama Sesuai KTP" autofocus />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="tgllahir">Tanggal Lahir</label>
                                                                    <input type="text" class="form-control date" name="tgllahir" id="tgllahir" required placeholder="Tanggal Lahir Sesuai KTP" autofocus />
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 statusmenikah">
                                                                <div class="form-group">
                                                                    <label for="statusnikah">Status Menikah</label>
                                                                    <select name="statusnikah" id="statusnikah" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                                        <option selected="selected">- Pilih -</option>
                                                                        <option value="Kawin">Kawin</option>
                                                                        <option value="Belum Kawin">Belum Kawin</option>
                                                                        <option value="Janda">Janda</option>
                                                                        <option value="Duda">Duda</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4 agama">
                                                                <label for="agama">Agama</label>
                                                                <select name="agama" id="agama" class="w-100 form-control">
                                                                    <option value="">- Pilih -</option>
                                                                    <option value="Islam">Islam</option>
                                                                    <option value="Katolik">Katolik</option>
                                                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                                                    <option value="Hindu">Hindu</option>
                                                                    <option value="Budha">Budha</option>
                                                                    <option value="Konghucu">Konghucu</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="tinggibadan">Tinggi Badan (cm)</label>
                                                                    <input type="number" class="form-control" name="tinggibadan" id="tinggibadan" placeholder="" required placeholder="Satuan cm, misal 160" autofocus />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="beratbadan">Berat Badan (kg)</label>
                                                                    <input type="number" class="form-control" name="beratbadan" id="beratbadan" placeholder="" required placeholder="Satuan kg, misal 56" autofocus />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="alamat">Alamat Tinggal</label>
                                                                    <textarea type="text" class="form-control" name="alamat" id="alamat" required placeholder="Alamat tinggal sesuai KTP" autofocus> </textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="kodepos">Kode Pos</label>
                                                                    <input type="number" class="form-control" name="kodepos" id="kodepos" placeholder="" required placeholder="Ketik Kode pos di sini" autofocus />
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <button type="button" id="btnback1" class="btn btn-flat btn-secondary"><?php echo lang('sebelumnya') ?></button>
                                                        <button type="button" id="btnSave2" class="btn btn-flat btn-primary"><?php echo lang('selanjutnya') ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pendidikanFormal" role="tabpanel" aria-labelledby="pendidikanFormal-tab">
                                            <div class="card pendidikanpencaker">
                                                <div class="card-header with-border">
                                                    <h3 class="card-title">Pendidikan Formal</h3>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-card">
                                                                <div class="alert alert-success" role="alert">
                                                                    Silakan isi data terkait pendidikan Anda pada bidang-bidang di bawah ini!
                                                                </div>

                                                                <form action="#" id="formpendidikanpencaker">
                                                                    <div class="row mb-5">
                                                                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
                                                                            <div class="form-group">
                                                                                <label for="tahunmasuk">Tahun Masuk</label>
                                                                                <input type="text" class="form-control year" name="tahunmasuk" id="tahunmasuk" autofocus />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
                                                                            <div class="form-group">
                                                                                <label for="tahunlulus">Tahun Lulus</label>
                                                                                <input type="text" class="form-control year" name="tahunlulus" id="tahunlulus" required autofocus />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                                                            <label for="jenjang">Jenjang</label>
                                                                            <select name="jenjang" id="jenjang" class="form-control select2 select2-danger">
                                                                                <option value="">-- Pilih Salah Satu --</option>
                                                                                <?php foreach ($jenjang as $jp) : ?>
                                                                                    <option value=" <?php echo $jp['id']; ?>"><?php echo $jp['jenjang']; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
                                                                            <div class="form-group">
                                                                                <label for="ipk">NEM/NUN/IPK</label>
                                                                                <input type="text" class="form-control" name="ipk" id="ipk" autofocus />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">
                                                                            <div class="form-group">
                                                                                <label for="nama_sekolah">Nama Sekolah/Perguruan Tinggi</label>
                                                                                <input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" required autofocus />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">
                                                                            <div class="form-group">
                                                                                <label for="keterampilan">Keterampilan/Jurusan</label>
                                                                                <input type="text" class="form-control" name="keterampilan" id="keterampilan" autofocus />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                                                                            <div class="ml-auto">
                                                                                <button type="button" id="btnSavePendidikan" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> <?php echo lang('save') ?></button>
                                                                                <button type="button" id="btnUpdatePendidikan" class="btn btn-primary btn-sm hide"><i class="fas fa-edit"></i> <?php echo lang('update') ?></button>
                                                                                <input type="hidden" name="idpendidikan">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                                <hr>
                                                                <div class="row mt-5">

                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
                                                                        <table style="width:100%" id="tabelpendidikanpencaker" class="table table-bordered table-hover table-striped">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="10px">No</th>
                                                                                    <th>Tahun Masuk</th>
                                                                                    <th>Tahun Lulus</th>
                                                                                    <th>Jenjang</th>
                                                                                    <th>Nama Sekolah</th>
                                                                                    <th>NEM/NUN/IPK</th>
                                                                                    <th>Keterampilan</th>
                                                                                    <th>Aksi</th>
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
                                                <div class="card-footer">
                                                    <button type="button" id="btnback2" class="btn btn-flat btn-secondary"><?php echo lang('sebelumnya') ?></button>
                                                    <button type="button" id="btnSave3" class="btn btn-flat btn-primary"><?php echo lang('selanjutnya') ?></button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="keterampilanBahasa" role="tabpanel" aria-labelledby="keterampilanBahasa-tab">
                                            <div class="card bahasapencaker">
                                                <div class="card-header with-border">
                                                    <h3 class="card-title">Keterampilan Bahasa</h3>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-card">
                                                                <div class="alert alert-success" role="alert">
                                                                    Silakan centang salah satu atau beberapa bahasa yang Anda kuasai di bawah ini!
                                                                </div>
                                                                <form action="#" id="formbahasapencaker">
                                                                    <div class="row mb-5">
                                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                            <div class="form-group clearfix">
                                                                                <div class="row">
                                                                                    <div class="col-12 col-sm-6 col-md-4 col-lg-2 mt-3">
                                                                                        <div class="icheck-primary d-inline mr-4">
                                                                                            <input type="checkbox" id="checkboxPrimary1">
                                                                                            <label for="checkboxPrimary1">Inggris</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-sm-6 col-md-4 col-lg-2 mt-3">
                                                                                        <div class="icheck-primary d-inline mr-4">
                                                                                            <input type="checkbox" id="checkboxPrimary2">
                                                                                            <label for="checkboxPrimary2">Jepang</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-sm-6 col-md-4 col-lg-2 mt-3">
                                                                                        <div class="icheck-primary d-inline mr-4">
                                                                                            <input type="checkbox" id="checkboxPrimary3">
                                                                                            <label for="checkboxPrimary3">Belanda</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-sm-6 col-md-4 col-lg-2 mt-3">
                                                                                        <div class="icheck-primary d-inline mr-4">
                                                                                            <input type="checkbox" id="checkboxPrimary4">
                                                                                            <label for="checkboxPrimary4">Jerman</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-sm-6 col-md-4 col-lg-2 mt-3">
                                                                                        <div class="icheck-primary d-inline mr-4">
                                                                                            <input type="checkbox" id="checkboxPrimary5">
                                                                                            <label for="checkboxPrimary5">Mandarin</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-sm-6 col-md-4 col-lg-2 mt-3">
                                                                                        <div class="icheck-primary d-inline mr-4">
                                                                                            <input type="checkbox" id="checkboxPrimary6">
                                                                                            <label for="checkboxPrimary6">Prancis</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-sm-6 col-md-4 col-lg-2 mt-3">
                                                                                        <div class="icheck-primary d-inline mr-4">
                                                                                            <input type="checkbox" id="checkboxPrimary7">
                                                                                            <label for="checkboxPrimary7">Arab</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="textboxbahasalainnya" class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
                                                                            <div class="form-floating">
                                                                                <label for="lainnya">Bahasa Lainnya</label>
                                                                                <textarea class="form-control" placeholder="Deskripsikan bahasa yang Anda kuasai di sini" name="txt_bahasa_lainnya" id="txt_bahasa_lainnya" style="height: 100px"></textarea>
                                                                            </div>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card-footer">
                                                    <button type="button" id="btnback3" class="btn btn-flat btn-secondary"><?php echo lang('sebelumnya') ?></button>
                                                    <button type="button" id="btnSave4" class="btn btn-flat btn-primary"><?php echo lang('selanjutnya') ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="pengalamanKerja" role="tabpanel" aria-labelledby="pengalamanKerja-tab">
                                        <div class="card pekerjaanpencaker">
                                            <div class="card-header with-border">
                                                <h3 class="card-title">Pengalaman Kerja</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-card">
                                                            <div class="alert alert-success" role="alert">
                                                                Silakan isi data terkait pengalaman kerja Anda pada bidang-bidang di bawah ini!
                                                            </div>
                                                            <form action="#" id="formpekerjaanpencaker">
                                                                <div class="row">
                                                                    <div class="col-12 col-sm-12 col-md-3 col-lg-2 ">
                                                                        <div class="form-group">
                                                                            <label for="tahunmasukkerja">Tahun Masuk</label>
                                                                            <input type="text" class="form-control year" name="tahunmasukkerja" id="tahunmasukkerja" placeholder="" required placeholder="Tahun masuk kerja" autofocus />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12 col-md-3 col-lg-2 ">
                                                                        <div class="form-group">
                                                                            <label for="tahunkeluarkerja">Tahun Keluar</label>
                                                                            <input type="text" class="form-control year" name="tahunkeluarkerja" id="tahunkeluarkerja" placeholder="" required placeholder="Tahun keluar kerja" autofocus />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12 col-md-3 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="instansi">Nama Perusahan/Instansi</label>
                                                                            <input type="text" class="form-control" name="instansi" id="instansi" placeholder="" required placeholder="Nama Perusahan/Instansi" autofocus />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12 col-md-3 col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="jabatan">Jabatan</label>
                                                                            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="" required placeholder="Tahun masuk sekolah" autofocus />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                                                                        <div class="ml-auto">
                                                                            <button type="button" id="btnSavePekerjaan" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> <?php echo lang('save') ?></button>
                                                                            <button type="button" id="btnUpdatePekerjaan" class="btn btn-primary btn-sm hide"><i class="fas fa-edit"></i> <?php echo lang('update') ?></button>
                                                                            <input type="hidden" name="idpekerjaan">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                            <hr>
                                                            <div class="row mt-5">
                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
                                                                    <table style="width:100%" id="tabelpekerjaanpencaker" class="table table-bordered table-hover table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="10px">No</th>
                                                                                <th>Tahun Masuk</th>
                                                                                <th>Tahun Keluar</th>
                                                                                <th>Nama Perusahan/Instansi</th>
                                                                                <th>Jabatan</th>
                                                                                <th>Aksi</th>
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
                                            <div class="card-footer">
                                                <button type="button" id="btnback4" class="btn btn-flat btn-secondary"><?php echo lang('sebelumnya') ?></button>
                                                <button type="button" id="btnSave5" class="btn btn-flat btn-primary"><?php echo lang('selanjutnya') ?></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="bidangPekerjaan" role="tabpanel" aria-labelledby="bidangPekerjaan-tab">
                                        <div class="card jabatanpencaker">
                                            <div class="card-header with-border">
                                                <h3 class="card-title">Bidang Pekerjaan Yang Diminati</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-card">
                                                            <div class="alert alert-success" role="alert">
                                                                Silakan isi data terkait bidang pekerjaan yang diminati
                                                            </div>
                                                            <form action="#" id="formjabatanpencaker">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <label for="minat_jabatan">Bidang Pekerjaan</label>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">
                                                                        <div class="form-group form-group-sm">
                                                                            <input type="text" class="form-control form-control-sm" name="minat_jabatan" id="minat_jabatan" required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                                                        <button type="button" id="btnSaveJabatan" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> <?php echo lang('save') ?></button>
                                                                        <button type="button" id="btnUpdateJabatan" class="btn btn-primary btn-sm hide"><i class="fas fa-edit"></i> <?php echo lang('update') ?></button>
                                                                        <input type="hidden" name="idjabatan">
                                                                    </div>
                                                                </div>
                                                            </form>

                                                            <div class="row mt-5">
                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
                                                                    <table style="width:100%" id="tabeljabatanpencaker" class="table table-bordered table-hover table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="10px">No</th>
                                                                                <th>Bidang Pekerjaan</th>
                                                                                <th>Aksi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <hr>
                                                            <br>
                                                            <div class="row mt-3">
                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                                                                    <label>Lokasi jabatan yang diinginkan</label>
                                                                </div>
                                                                <form action="#" id="formlokasijabatan">
                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="lokasi_jabatan" id="lokasijabatan1" value="DN">
                                                                            <label class="form-check-label" for="lokasijabatan1">
                                                                                Dalam Negeri
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="lokasi_jabatan" id="lokasijabatan2" value="LN">
                                                                            <label class="form-check-label" for="lokasijabatan2">
                                                                                Luar Negeri
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="card-footer">
                                                <button type="button" id="btnback5" class="btn btn-flat btn-secondary"><?php echo lang('sebelumnya') ?></button>
                                                <button type="button" id="btnSave6" class="btn btn-flat btn-primary"><?php echo lang('selanjutnya') ?></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="perusahaanTujuan" role="tabpanel" aria-labelledby="perusahaanTujuan-tab">
                                        <div class="card perusahaanpencaker">
                                            <div class="card-header with-border">
                                                <h3 class="card-title">Perusahaan/Instansi Yang Dituju</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-card">
                                                            <div class="alert alert-success" role="alert">
                                                                Silakan tentukan tujuan perusahaan/instansi pilihan Anda!
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <form id="formtujuanperusahaan" class="w-100">
                                                            <div class="row">
                                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="tujuan_namaperusahaan">Nama Perusahaan/Instansi</label>
                                                                        <input type="text" class="form-control" name="tujuan_namaperusahaan" id="tujuan_namaperusahaan">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="tujuan_nohpperusahaan">Nomor Telepon Instansi</label>
                                                                        <input type="text" class="form-control" name="tujuan_nohpperusahaan" id="tujuan_nohpperusahaan">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="tujuan_alamatperusahaan">Alamat</label>
                                                                        <textarea class="form-control" name="tujuan_alamatperusahaan" id="tujuan_alamatperusahaan"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="card-footer">
                                                <button type="button" id="btnback6" class="btn btn-flat btn-secondary"><?php echo lang('sebelumnya') ?></button>
                                                <button type="button" id="btnSave7" class="btn btn-flat btn-primary"><?php echo lang('selanjutnya') ?></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="keteranganTambahan" role="tabpanel" aria-labelledby="keteranganTambahan-tab">
                                        <div class="card datatambahanpencaker">
                                            <div class="card-header with-border">
                                                <h3 class="card-title">Keterangan Tambahan</h3>
                                            </div>
                                            <form action="#" id="formcatatanpengantar">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-card">
                                                                <div class="alert alert-success" role="alert">
                                                                    Catatan pengantar kerja yang berkaitan dengan faktor-faktor yang mempengaruhi pekerjaan!
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                                                                        <div class="form-group">
                                                                            <label for="catatan_pengantar">Catatan Pencaker</label>
                                                                            <textarea type="text" class="form-control" name="catatan_pengantar" id="catatan_pengantar" rows="3" required placeholder="Tahun masuk sekolah" autofocus></textarea>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card-footer">
                                                    <button type="button" id="btnback7" class="btn btn-flat btn-secondary"><?php echo lang('sebelumnya') ?></button>
                                                    <button type="button" id="btnSave8" class="btn btn-flat btn-primary">Selesai</button>
                                                </div>
                                            </form>
                                        </div>
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

<script src="<?php echo base_url('adminltev31/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/select2/js/select2.full.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/inputmask/jquery.inputmask.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/bs-stepper/js/bs-stepper.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/dropzone/min/dropzone.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/dist/js/adminlte.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/dist/js/demo.js'); ?>"></script>
<?= $this->endSection() ?>