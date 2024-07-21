<?= $this->extend('admin/template') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('adminltev31/plugins/datatables-responsive/css/responsive.bootstrap4.min.css'); ?>">
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

    .form-control {
        text-transform: uppercase;
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
            <div class="card card-default">
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
                                                    <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" disabled value="<?= $id_pencaker['id']; ?>">
                                                    <div class="row mt-3" id="pilihTujuan">
                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-3">
                                                            <span>Pilih Tujuan Anda</span>
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
                                                <button type="button" id="btnSave1" class="btn btn-flat btn-primary">Selanjutnya</button>
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

                                                    <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" disabled value="<?= $id_pencaker['id']; ?>">
                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="nopendaftaran">Nomor Pendaftaran</label>
                                                            <input type="text" class="form-control" name="nopendaftaran" id="nopendaftaran" disabled value="<?= $nopendaftaran; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="nik">NIK</label>
                                                            <input type="text" class="form-control" name="nik" id="nik" value="<?= $user['nik']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="namalengkap">Nama Lengkap</label>
                                                            <input type="text" class="form-control" name="namalengkap" id="namalengkap" value="<?= $user['namalengkap']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="nohp">Nomor HP</label>
                                                            <input type="text" class="form-control" name="nohp" id="nohp" value="<?= $user['nohp']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" class="form-control" name="email" id="email" value="<?= $user['email']; ?>" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                        <div class="form-group mb-0">
                                                            <span>Jenis Kelamin</span>
                                                            <div class="row mt-3">
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
                                                            <input type="text" class="form-control" name="tempatlahir" id="tempatlahir" placeholder="Tempat Lahir Sesuai KTP">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                        <div class="form-group">
                                                            <label for="tgllahir">Tanggal Lahir</label>
                                                            <input type="date" name="tgllahir" id="tgllahir" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class=" col-12 col-sm-12 col-md-4 col-lg-4 statusmenikah">
                                                        <div class="form-group">
                                                            <label for="statusnikah">Status Menikah</label>
                                                            <select name="statusnikah" id="statusnikah" class="w-100 form-control">
                                                                <option value="">- Pilih -</option>
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
                                                            <textarea type="text" class="form-control" name="alamat" id="alamat" required placeholder="Alamat tinggal sesuai KTP"></textarea>
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
                                                <button type="button" id="btnback1" class="btn btn-flat btn-secondary">Sebelumnya</button>
                                                <button type="button" id="btnSave2" class="btn btn-flat btn-primary">Selanjutnya</button>
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
                                                                <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" disabled value="<?= $id_pencaker['id']; ?>">
                                                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
                                                                    <div class="form-group">
                                                                        <label for="tahunmasuk">Tahun Masuk</label>
                                                                        <input type="number" class="form-control year" name="tahunmasuk" id="tahunmasuk" autofocus required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
                                                                    <div class="form-group">
                                                                        <label for="tahunlulus">Tahun Lulus</label>
                                                                        <input type="number" class="form-control year" name="tahunlulus" id="tahunlulus" required autofocus required />
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                                                                    <label for="jenjang">Jenjang</label>
                                                                    <select name="jenjang" id="jenjang" class="form-control">
                                                                        <option value="">-- Pilih Salah Satu --</option>
                                                                        <?php foreach ($jenjang as $jp) : ?>
                                                                            <option value="<?php echo $jp['id']; ?>"><?php echo $jp['jenjang']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-3 col-lg-3 ">
                                                                    <div class="form-group">
                                                                        <label for="ipk">NEM/NUN/IPK</label>
                                                                        <input type="text" class="form-control" name="ipk" id="ipk" autofocus required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">
                                                                    <div class="form-group">
                                                                        <label for="nama_sekolah">Nama Sekolah/Perguruan Tinggi</label>
                                                                        <input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" required autofocus required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 ">
                                                                    <div class="form-group">
                                                                        <label for="keterampilan">Keterampilan/Jurusan</label>
                                                                        <input type="text" class="form-control" name="keterampilan" id="keterampilan" autofocus required />
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                                                                    <div class="ml-auto">
                                                                        <button type="button" id="btnSavePendidikan" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                                                                        <button type="button" id="btnUpdatePendidikan" class="btn btn-primary btn-sm hide"><i class="fas fa-edit"></i> Perbarui</button>
                                                                        <input type="hidden" name="idpendidikan">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="row mt-5">
                                                            <div class="col-12">
                                                                <table id="tabelPendidikan" class="table table-bordered table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>No.</th>
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
                                            <button type="button" id="btnback2" class="btn btn-flat btn-secondary">Sebelumnya</button>
                                            <button type="button" id="btnSave3" class="btn btn-flat btn-primary">Selanjutnya</button>
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
                                                                <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" disabled value="<?= $id_pencaker['id']; ?>">
                                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                    <div class="form-group clearfix">
                                                                        <div class="row">
                                                                            <?php foreach ($bahasa as $index => $b) : ?>
                                                                                <div class="col-12 col-sm-6 col-md-4 col-lg-2 mt-3">
                                                                                    <div class="icheck-primary d-inline mr-4">
                                                                                        <input type="checkbox" id="checkboxPrimary<?= $index + 1 ?>" name="keterampilan_bahasa[]" value="<?= $b['bahasa'] ?>">
                                                                                        <label for="checkboxPrimary<?= $index + 1 ?>"><?= $b['bahasa'] ?></label>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="textboxbahasalainnya" class="col-12 col-sm-12 col-md-12 col-lg-12 mt-4">
                                                                    <div class="form-floating">
                                                                        <span>Bahasa Lainnya</span>
                                                                        <textarea class="form-control" placeholder="Deskripsikan bahasa yang Anda kuasai di sini" name="txt_bahasa_lainnya" id="txt_bahasa_lainnya" style="height: 100px"></textarea>
                                                                    </div>
                                                                </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="button" id="btnback3" class="btn btn-flat btn-secondary">Sebelumnya</button>
                                            <button type="button" id="btnSave4" class="btn btn-flat btn-primary">Selanjutnya</button>
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
                                                            <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" disabled value="<?= $id_pencaker['id']; ?>">
                                                            <div class="col-12 col-sm-12 col-md-3 col-lg-2 ">
                                                                <div class="form-group">
                                                                    <label for="tahunmasukkerja">Tahun Masuk</label>
                                                                    <input type="number" class="form-control year" name="tahunmasukkerja" id="tahunmasukkerja" placeholder="" required placeholder="Tahun masuk kerja">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-3 col-lg-2 ">
                                                                <div class="form-group">
                                                                    <label for="tahunkeluarkerja">Tahun Keluar</label>
                                                                    <input type="number" class="form-control year" name="tahunkeluarkerja" id="tahunkeluarkerja" placeholder="" required placeholder="Tahun keluar kerja">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-3 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="instansi">Nama Perusahan/Instansi</label>
                                                                    <input type="text" class="form-control" name="instansi" id="instansi" placeholder="" required placeholder="Nama Perusahan/Instansi">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-3 col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="jabatan">Jabatan</label>
                                                                    <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="" required placeholder="Tahun masuk sekolah">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                                                                <div class="ml-auto">
                                                                    <button type="button" id="btnSavePekerjaan" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                                                                    <button type="button" id="btnUpdatePekerjaan" class="btn btn-primary btn-sm hide"><i class="fas fa-edit"></i> Perbarui</button>
                                                                    <input type="hidden" name="idpekerjaan">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <div class="row mt-5">
                                                        <div class="col-12">
                                                            <table id="tabelPekerjaan" class="table table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
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
                                        <button type="button" id="btnback4" class="btn btn-flat btn-secondary">Sebelumnya</button>
                                        <button type="button" id="btnSave5" class="btn btn-flat btn-primary">Selanjutnya</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="bidangPekerjaan" role="tabpanel" aria-labelledby="bidangPekerjaan-tab">
                                <div class="card identitaspencaker">
                                    <div class="card-header with-border">
                                        <h3 class="card-title">Keterangan Umum Identitas Pencaker</h3>
                                    </div>
                                    <form action="#" id="formbidangPekerjaan">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-card">
                                                        <div class="alert alert-success" role="alert">
                                                            Lengkapi data diri Anda di bawah ini!
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" disabled value="<?= $id_pencaker['id']; ?>">
                                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="nama_jabatan">Bidang Pekerjaan</label>
                                                        <input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan">
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                                    <div class="form-group mb-0">
                                                        <span>Pilih Lokasi Jabatan Anda</span>
                                                        <div class="row mt-3">
                                                            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="lokasi_jabatan" id="lokasijabatan1" value="DN">
                                                                    <label class="form-check-label" for="lokasijabatan1">
                                                                        Dalam Negeri
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="lokasi_jabatan" id="lokasijabatan2" value="LN">
                                                                    <label class="form-check-label" for="lokasijabatan2">
                                                                        Luar Negeri
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" id="btnback8" class="btn btn-flat btn-secondary">Sebelumnya</button>
                                            <button type="button" id="btnSave9" class="btn btn-flat btn-primary">Selanjutnya</button>
                                        </div>
                                    </form>
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
                                                        <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" value="<?= $id_pencaker['id']; ?>">
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label for="nama_perusahaan">Nama Perusahaan/Instansi</label>
                                                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label for="nohp_perusahaan">Nomor Telepon Instansi</label>
                                                                <input type="text" class="form-control" name="nohp_perusahaan" id="nohp_perusahaan">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label for="alamat_perusahaan">Alamat</label>
                                                                <textarea class="form-control" name="alamat_perusahaan" id="alamat_perusahaan"></textarea>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id_perusahaan" id="id_perusahaan">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button type="button" id="btnback6" class="btn btn-flat btn-secondary">Sebelumnya</button>
                                        <button type="button" id="btnSave7" class="btn btn-flat btn-primary">Selanjutnya</button>
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
                                                            <input type="hidden" class="form-control" name="id_pencaker" id="id_pencaker" value="<?= $id_pencaker['id']; ?>">
                                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="catatan_pengantar">Catatan Pencaker</label>
                                                                    <textarea class="form-control" name="catatan_pengantar" id="catatan_pengantar" rows="3" required autofocus></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" id="btnback7" class="btn btn-flat btn-secondary">Sebelumnya</button>
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
</section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url('adminltev31/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('adminltev31/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var id_pencaker = $('#id_pencaker').val();

        function fillForm(data) {
            $('input[name="tujuan"][value="' + data.tujuan + '"]').prop('checked', true);
            togglePerusahaanTab();
        }

        function togglePerusahaanTab() {
            const tujuan1Radio = document.getElementById('tujuan1');
            const tujuan2Radio = document.getElementById('tujuan2');
            const perusahaanTujuanTab = document.getElementById('perusahaanTujuan-tab');
            const perusahaanTujuanContent = document.getElementById('perusahaanTujuan');

            if (tujuan1Radio && tujuan1Radio.checked) {
                if (perusahaanTujuanTab) perusahaanTujuanTab.style.display = 'none';
                if (perusahaanTujuanContent) perusahaanTujuanContent.classList.add('show');
            } else if (tujuan2Radio && tujuan2Radio.checked) {
                if (perusahaanTujuanTab) perusahaanTujuanTab.style.display = 'block';
                if (perusahaanTujuanContent) perusahaanTujuanContent.classList.remove('show');
            }
        }

        $('input[name="tujuan"]').change(togglePerusahaanTab);

        $.ajax({
            url: '<?= site_url("pencaker/get_data_tujuan/") ?>' + id_pencaker,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                fillForm(response);
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });

        $('#btnSave1').on('click', function() {
            var formData = {
                id_pencaker: id_pencaker,
                tujuan: $('input[name="tujuan"]:checked').val(),
            };

            $.ajax({
                url: '<?= site_url("pencaker/save_data_tujuan") ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data berhasil disimpan.',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#keteranganUmum-tab').tab('show');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                    });
                }

            });
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('#btnSave2').on('click', function() {
            var formData = {
                id_pencaker: $('#id_pencaker').val(),
                nopendaftaran: $('#nopendaftaran').val(),
                nik: $('#nik').val(),
                namalengkap: $('#namalengkap').val(),
                nohp: $('#nohp').val(),
                email: $('#email').val(),
                jenkel: $('input[name="jenkel"]:checked').val(),
                tempatlahir: $('#tempatlahir').val(),
                tgllahir: $('#tgllahir').val(),
                statusnikah: $('#statusnikah').val(),
                agama: $('#agama').val(),
                tinggibadan: $('#tinggibadan').val(),
                beratbadan: $('#beratbadan').val(),
                alamat: $('#alamat').val(),
                kodepos: $('#kodepos').val()
            };

            $.ajax({
                url: '<?= site_url("pencaker/save_data_keterangan_umum") ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data berhasil disimpan.',
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $('#pendidikanFormal-tab').tab('show');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                    });
                }
            });

        });

        var pencakerId = $('#id_pencaker').val();
        var tabelPendidikan = $('#tabelPendidikan').DataTable({
            "processing": true,
            "serverSide": false,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                "url": "<?= base_url('pencaker/fetch_data_pendidikan') ?>",
                "type": "POST",
                "data": function(d) {
                    d.pencaker_id = pencakerId;
                }
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "tahunmasuk"
                },
                {
                    "data": "tahunlulus"
                },
                {
                    "data": "jenjang"
                },
                {
                    "data": "nama_sekolah"
                },
                {
                    "data": "ipk"
                },
                {
                    "data": "keterampilan"
                },
                {
                    "data": "aksi",
                    "orderable": false,
                    "searchable": false
                }
            ]
        });

        $('#tabelPendidikan').on('click', '.deletePendidikan', function() {
            var idPendidikan = $(this).data('id'); // Ambil id dari tombol yang diklik

            // Tampilkan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus pelatihan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user mengonfirmasi, lakukan proses hapus via AJAX
                    $.ajax({
                        url: '<?= base_url('pencaker/hapus_data_pendidikan') ?>',
                        type: 'POST',
                        data: {
                            id: idPendidikan // Kirim id pendidikan yang akan dihapus
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                tabelPendidikan.ajax.reload(); // Reload tabel setelah hapus
                                Swal.fire(
                                    'Sukses!',
                                    'Pelatihan berhasil dihapus.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus pelatihan.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus pelatihan.',
                                'error'
                            );
                        }
                    });
                }
            });
        });


        // Event untuk tombol Save
        $('#btnSavePendidikan').click(function() {
            var data = {
                nama_sekolah: $('#nama_sekolah').val(),
                tahunmasuk: $('#tahunmasuk').val(),
                tahunlulus: $('#tahunlulus').val(),
                ipk: $('#ipk').val(),
                keterampilan: $('#keterampilan').val(),
                pencaker_id: $('#id_pencaker').val(), // Pastikan nilai ini sudah benar
                jenjang: $('#jenjang').val()
            };

            $.ajax({
                url: '<?= base_url('pencaker/save_data_pendidikan') ?>',
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire(
                            'Berhasil!',
                            response.message,
                            'success'
                        );
                        // Reload tabel setelah berhasil menyimpan data
                        tabelPendidikan.ajax.reload();
                        // Bersihkan form
                        $('#formpendidikanpencaker')[0].reset();
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat menyimpan data.',
                        'error'
                    );
                }
            });
        });


        $('#tabelPendidikan').on('click', '.editPendidikan', function() {
            // Ambil id dari data pendidikan
            var id = $(this).data('id');
            // Kirim AJAX request untuk mendapatkan data pendidikan berdasarkan id
            $.ajax({
                url: '<?= base_url('pencaker/get_pendidikan_by_id') ?>',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    // Isi data dari response ke dalam form input
                    $('#tahunmasuk').val(response.tahunmasuk);
                    $('#tahunlulus').val(response.tahunlulus);
                    $('#jenjang').val(response.jenjang_pendidikan_id).trigger('change'); // Menggunakan jenjang_pendidikan_id
                    $('#ipk').val(response.ipk);
                    $('#nama_sekolah').val(response.nama_sekolah);
                    $('#keterampilan').val(response.keterampilan);

                    // Ubah tombol Save menjadi Update
                    $('#btnSavePendidikan').addClass('hide');
                    $('#btnUpdatePendidikan').removeClass('hide');

                    // Simpan id pendidikan di form untuk digunakan saat proses update
                    $('input[name="idpendidikan"]').val(response.id);
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan saat mengambil data pendidikan:', error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat mengambil data pendidikan.',
                        'error'
                    );
                }
            });
        });

        // Event handler untuk tombol Update pada form input Pendidikan

        $('#btnUpdatePendidikan').click(function() {
            // var pencaker_ID = $(this).data('pencaker_id');
            var data = {
                id: $('input[name="idpendidikan"]').val(),
                nama_sekolah: $('#nama_sekolah').val(),
                tahunmasuk: $('#tahunmasuk').val(),
                tahunlulus: $('#tahunlulus').val(),
                ipk: $('#ipk').val(),
                keterampilan: $('#keterampilan').val(),
                jenjang: $('#jenjang').val(),
            };

            $.ajax({
                url: '<?= base_url('pencaker/update_data_pendidikan') ?>',
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.status === 'success') {
                        // Reload tabel setelah berhasil update
                        tabelPendidikan.ajax.reload();
                        Swal.fire(
                            'Sukses!',
                            'Data pendidikan berhasil diperbarui.',
                            'success'
                        );

                        // Bersihkan form setelah update
                        $('#formpendidikanpencaker')[0].reset();
                        $('input[name="idpendidikan"]').val('');
                        $('#btnUpdatePendidikan').addClass('hide');
                        $('#btnSavePendidikan').removeClass('hide');
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat memperbarui data pendidikan.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan saat memperbarui data pendidikan:', error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat memperbarui data pendidikan.',
                        'error'
                    );
                }
            });
        });


        $('#btnSave3').on('click', function() {
            $('#keterampilanBahasa-tab').tab('show');
        });

        // $('#btnSave4').on('click', function() {
        //     $('#pengalamanKerja-tab').tab('show');
        // });
        $('#btnSave5').on('click', function() {
            $('#bidangPekerjaan-tab').tab('show');
        });
        $('#btnSave6').on('click', function() {
            $('#perusahaanTujuan-tab').tab('show');
        });
        // $('#btnSave7').on('click', function() {
        //     $('#keteranganTambahan-tab').tab('show');
        // });

    });
</script>

<script>
    $(document).ready(function() {
        // ID user yang akan digunakan untuk mengambil data
        var userId = $('#id_pencaker').val();

        // Fungsi untuk mengisi form dengan data yang diambil dari server
        function fillForm(data) {
            $('input[name="jenkel"][value="' + data.jenkel + '"]').prop('checked', true);
            $('#tempatlahir').val(data.tempatlahir);
            $('#tgllahir').val(data.tgllahir);
            $('#statusnikah').val(data.statusnikah);
            $('#agama').val(data.agama);
            $('#tinggibadan').val(data.tinggibadan);
            $('#beratbadan').val(data.beratbadan);
            $('#alamat').val(data.alamat);
            $('#kodepos').val(data.kodepos);
        }

        // AJAX request untuk mengambil data berdasarkan user_id
        $.ajax({
            url: '<?= site_url("pencaker/get_data_keterangan_umum/") ?>' + userId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                fillForm(response);
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var pencakerId = $('#id_pencaker').val(); // Pastikan elemen ini memiliki pencaker_id
        var tabelPekerjaan = $('#tabelPekerjaan').DataTable({
            "processing": true,
            "serverSide": false, // Ubah ke true jika menggunakan server-side processing
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                "url": "<?= base_url('pencaker/fetch_data_pengalaman_kerja') ?>",
                "type": "POST",
                "data": function(d) {
                    d.pencaker_id = pencakerId; // Kirim pencaker_id
                }
            },
            "columns": [{
                    "data": "no"
                },
                {
                    "data": "tahunmasuk"
                },
                {
                    "data": "tahunkeluar"
                },
                {
                    "data": "instansi"
                },
                {
                    "data": "jabatan"
                },
                {
                    "data": "aksi",
                    "orderable": false,
                    "searchable": false
                }
            ]
        });

        // Event untuk tombol Save
        $('#btnSavePekerjaan').click(function() {
            var data = {
                tahunmasukkerja: $('#tahunmasukkerja').val(),
                tahunkeluarkerja: $('#tahunkeluarkerja').val(),
                instansi: $('#instansi').val(),
                jabatan: $('#jabatan').val(),
                pencaker_id: $('#id_pencaker').val(), // Pastikan nilai ini sudah benar
            };

            $.ajax({
                url: '<?= base_url('pencaker/save_data_pengalaman_kerja') ?>',
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire(
                            'Berhasil!',
                            response.message,
                            'success'
                        );
                        // Reload tabel setelah berhasil menyimpan data
                        tabelPekerjaan.ajax.reload();
                        // Bersihkan form
                        $('#formpekerjaanpencaker')[0].reset();
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat menyimpan data.',
                        'error'
                    );
                }
            });
        });


        $('#tabelPekerjaan').on('click', '.deletePekerjaan', function() {
            var idpekerjaan = $(this).data('id'); // Ambil id dari tombol yang diklik

            // Tampilkan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus pelatihan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user mengonfirmasi, lakukan proses hapus via AJAX
                    $.ajax({
                        url: '<?= base_url('pencaker/hapus_data_pengalaman_kerja') ?>',
                        type: 'POST',
                        data: {
                            id: idpekerjaan // Kirim id pendidikan yang akan dihapus
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                tabelPekerjaan.ajax.reload(); // Reload tabel setelah hapus
                                Swal.fire(
                                    'Sukses!',
                                    'Pelatihan berhasil dihapus.',
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan saat menghapus pelatihan.',
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus pelatihan.',
                                'error'
                            );
                        }
                    });
                }
            });
        });



        $('#tabelPekerjaan').on('click', '.editPekerjaan', function() {
            // Ambil id dari data pekerjaan
            var idpekerjaan = $(this).data('id');
            // Kirim AJAX request untuk mendapatkan data pekerjaan berdasarkan id
            $.ajax({
                url: '<?= base_url('pencaker/get_pengalaman_kerja_by_id') ?>',
                type: 'POST',
                data: {
                    id: idpekerjaan
                },
                dataType: 'json',
                success: function(response) {
                    // Isi data dari response ke dalam form input
                    $('#tahunmasukkerja').val(response.tahunmasuk);
                    $('#tahunkeluarkerja').val(response.tahunkeluar);
                    $('#instansi').val(response.instansi);
                    $('#jabatan').val(response.jabatan);

                    // Ubah tombol Save menjadi Update
                    $('#btnSavePekerjaan').addClass('hide');
                    $('#btnUpdatePekerjaan').removeClass('hide');

                    // Simpan id pekerjaan di form untuk digunakan saat proses update
                    $('input[name="idpekerjaan"]').val(response.id);
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan saat mengambil data pekerjaan:', error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat mengambil data pekerjaan.',
                        'error'
                    );
                }
            });
        });


        // Event handler untuk tombol Update pada form input Pendidikan

        $('#btnUpdatePekerjaan').click(function() {
            var data = {
                id: $('input[name="idpekerjaan"]').val(), // Pastikan Anda mendapatkan ID dari input form
                tahunmasukkerja: $('#tahunmasukkerja').val(),
                tahunkeluarkerja: $('#tahunkeluarkerja').val(),
                instansi: $('#instansi').val(),
                jabatan: $('#jabatan').val(),
            };

            console.log('Data yang dikirim:', data);

            $.ajax({
                url: '<?= base_url('pencaker/update_data_pengalaman_kerja') ?>',
                type: 'POST',
                data: data,
                success: function(response) {
                    console.log('Response dari server:', response);
                    if (response.status === 'success') {
                        tabelPekerjaan.ajax.reload();
                        Swal.fire(
                            'Sukses!',
                            'Data pendidikan berhasil diperbarui.',
                            'success'
                        );

                        $('#formpekerjaanpencaker')[0].reset();
                        $('input[name="idpekerjaan"]').val('');
                        $('#btnUpdatePekerjaan').addClass('hide');
                        $('#btnSavePekerjaan').removeClass('hide');
                    } else {
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat memperbarui data pendidikan.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan saat memperbarui data pendidikan:', error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat memperbarui data pendidikan.',
                        'error'
                    );
                }
            });
        });

    });
</script>

<!-- Bagian Jabatan yang diminati -->
<script>
    $(document).ready(function() {
        // Catatan Tambahan
        $('#btnSave8').on('click', function() {
            var formData = {
                id_pencaker: $('#id_pencaker').val(),
                catatan_pengantar: $('#catatan_pengantar').val(),
            };

            $.ajax({
                url: '<?= site_url("pencaker/save_catatan_pengantar") ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses!',
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Anda dapat menambahkan logika setelah data berhasil disimpan, misalnya mengarahkan ke halaman lain
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status + ' - ' + error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                    });
                }
            });
        });

        // Fungsi untuk mengisi form dengan data yang diambil dari server
        function fillForm(data) {
            $('#catatan_pengantar').val(data.catatan_pengantar);
        }

        // AJAX request untuk mengambil data berdasarkan user_id
        $(document).ready(function() {
            var id_pencaker = $('#id_pencaker').val();

            $.ajax({
                url: '<?= site_url("pencaker/get_catatan_pengantar_by_id/") ?>' + id_pencaker,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    fillForm(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error: ' + status + ' - ' + error);
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function() {
        var id = $('#id_pencaker').val();

        // Fungsi untuk mengisi form dengan data yang diambil dari server
        function fillForm(data) {
            $('#nama_perusahaan').val(data.nama_perusahaan);
            $('#nohp_perusahaan').val(data.nohp_perusahaan);
            $('#alamat_perusahaan').val(data.alamat_perusahaan);
            $('#id_perusahaan').val(data.id); // Tambahkan id perusahaan jika ada
        }

        // AJAX request untuk mengambil data berdasarkan id
        $.ajax({
            url: '<?= site_url("pencaker/get_perusahaan_tujuan_by_id/") ?>' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response && !response.error) {
                    fillForm(response);
                } else {
                    console.error('Error: Data tidak ditemukan.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });

        $('#btnSave7').click(function() {
            var data = {
                id: $('#formtujuanperusahaan #id_perusahaan').val(), // Ambil id perusahaan jika ada
                nama_perusahaan: $('#formtujuanperusahaan #nama_perusahaan').val(),
                nohp_perusahaan: $('#formtujuanperusahaan #nohp_perusahaan').val(),
                alamat_perusahaan: $('#formtujuanperusahaan #alamat_perusahaan').val(),
                pencaker_id: $('#formtujuanperusahaan #id_pencaker').val(),
            };

            $.ajax({
                url: '<?= base_url('pencaker/save_data_perusahaan_tujuan') ?>',
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Arahkan ke tab keteranganTambahan-tab
                                $('#keteranganTambahan-tab').tab('show');
                            }
                        });
                        $('#formtujuanperusahaan')[0].reset();
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat menyimpan data.',
                        'error'
                    );
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function() {
        $('#btnSave4').on('click', function() {
            var bahasaDipilih = [];
            $('input[type=checkbox]:checked').each(function() {
                bahasaDipilih.push($(this).next('label').text());
            });

            var bahasaLainnya = $('#txt_bahasa_lainnya').val();
            var idPencaker = $('#id_pencaker').val();

            $.ajax({
                url: '<?= base_url('pencaker/save_bahasa') ?>',
                type: 'POST',
                data: {
                    id_pencaker: idPencaker,
                    keterampilan_bahasa: bahasaDipilih.join(', '),
                    bahasa_lainnya: bahasaLainnya
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: response.message
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Pindah ke tab berikutnya
                                $('#pengalamanKerja-tab').tab('show');
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menyimpan data'
                    });
                }
            });
        });

        const userId = <?= $user['id']; ?>;
        $.ajax({
            url: '<?= base_url('pencaker/get_bahasa_pencaker_by_id') ?>/' + userId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    console.log(response.error);
                } else {
                    // Centang checkbox yang sesuai
                    const keterampilanBahasa = response.keterampilan_bahasa ? response.keterampilan_bahasa.split(', ') : [];
                    keterampilanBahasa.forEach(function(bahasa) {
                        $('input[name="keterampilan_bahasa[]"][value="' + bahasa + '"]').prop('checked', true);
                    });

                    // Isi textarea bahasa lainnya
                    $('#txt_bahasa_lainnya').val(response.bahasa_lainnya);
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#btnSave9').on('click', function() {
            var formData = {
                id_pencaker: $('#id_pencaker').val(),
                nama_jabatan: $('#nama_jabatan').val(),
                lokasi_jabatan: $('input[name="lokasi_jabatan"]:checked').val(),
            };

            $.ajax({
                url: '<?= site_url("pencaker/save_data_minat_jabatan") ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data berhasil disimpan.',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#perusahaanTujuan-tab').tab('show');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menyimpan data.',
                    });
                }
            });
        });

        var userId = $('#id_pencaker').val();
        // Fungsi untuk mengisi form dengan data yang diambil dari server
        function fillForm(data) {
            if (data.lokasi_jabatan) {
                $('input[name="lokasi_jabatan"][value="' + data.lokasi_jabatan + '"]').prop('checked', true);
            }
            $('#nama_jabatan').val(data.nama_jabatan);
        }

        // AJAX request untuk mengambil data berdasarkan user_id
        $.ajax({
            url: '<?= site_url("pencaker/get_data_minat_jabatan/") ?>' + userId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                fillForm(response);
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + status + ' - ' + error);
            }
        });
    });
</script>


<?= $this->endSection() ?>