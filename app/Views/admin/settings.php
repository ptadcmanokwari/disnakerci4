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
                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pengaturanUmum-tab" data-toggle="pill" href="#pengaturanUmum" role="tab" aria-controls="pengaturanUmum" aria-selected="true">Pengaturan Umum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pengaturanMedia-tab" data-toggle="pill" href="#pengaturanMedia" role="tab" aria-controls="pengaturanMedia" aria-selected="false">Pengaturan Media Sosial</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pengaturanSMTP-tab" data-toggle="pill" href="#pengaturanSMTP" role="tab" aria-controls="pengaturanSMTP" aria-selected="false">Pengaturan SMTP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pengaturanCaptcha-tab" data-toggle="pill" href="#pengaturanCaptcha" role="tab" aria-controls="pengaturanCaptcha" aria-selected="false">Pengaturan Captcha</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="pengaturanUmum" role="tabpanel" aria-labelledby="pengaturanUmum-tab">
                                    <div class="card">
                                        <?php if (session()->getFlashdata('success')) : ?>
                                            <div class="alert alert-success m-3">
                                                <?= session()->getFlashdata('success') ?>
                                            </div>
                                        <?php endif; ?>
                                        <form action="<?= base_url('admin_v2/update_detailinstansi') ?>" method="POST">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="company_name">Nama Instansi</label>
                                                            <input type="text" class="form-control" name="company_name" id="company_name" value="<?= isset($settings['company_name']) ? esc($settings['company_name']) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="company_email">Email Instansi</label>
                                                            <input type="text" class="form-control" name="company_email" id="company_email" value="<?= isset($settings['company_email']) ? esc($settings['company_email']) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="company_address">Alamat I Instansi</label>
                                                            <input type="text" class="form-control" name="company_address" id="company_address" value="<?= isset($settings['company_address']) ? esc($settings['company_address']) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="company_phone1">Alamat II Instansi</label>
                                                            <input type="text" class="form-control" name="company_phone1" id="company_phone1" value="<?= isset($settings['company_phone1']) ? esc($settings['company_phone1']) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="company_phone2">No Telepon Instansi</label>
                                                            <input type="text" class="form-control" name="company_phone2" id="company_phone2" value="<?= isset($settings['company_phone2']) ? esc($settings['company_phone2']) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="company_whatsapp">No. WhatsApp Instansi (Notifikasi)</label>
                                                            <input type="text" class="form-control" name="company_whatsapp" id="company_whatsapp" value="<?= isset($settings['company_whatsapp']) ? esc($settings['company_whatsapp']) : '' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-flat btn-primary">Perbarui</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pengaturanMedia" role="tabpanel" aria-labelledby="pengaturanMedia-tab">
                                    <div class="card">
                                        <?php if (session()->getFlashdata('success')) : ?>
                                            <div class="alert alert-success m-3">
                                                <?= session()->getFlashdata('success') ?>
                                            </div>
                                        <?php endif; ?>
                                        <form action="<?= base_url('admin_v2/update_mediasosial') ?>" method="POST">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="instansi">Facebook</label>
                                                            <input type="text" class="form-control" name="instansi" id="instansi">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="email_instansi">X</label>
                                                            <input type="email" class="form-control" name="email_instansi" id="email_instansi">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="alamat1">Instagram</label>
                                                            <input type="text" class="form-control" name="alamat1" id="alamat1">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="alamat2">Youtube</label>
                                                            <input type="text" class="form-control" name="alamat2" id="alamat2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-flat btn-primary">Perbarui</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pengaturanSMTP" role="tabpanel" aria-labelledby="pengaturanSMTP-tab">
                                    <div class="card">
                                        <?php if (session()->getFlashdata('success')) : ?>
                                            <div class="alert alert-success m-3">
                                                <?= session()->getFlashdata('success') ?>
                                            </div>
                                        <?php endif; ?>
                                        <form action="<?= base_url('admin_v2/update_smtp') ?>" method="POST">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="smtp_host">SMTP Host</label>
                                                            <input type="text" class="form-control" name="smtp_host" id="smtp_host" value="<?= isset($settings['smtp_host']) ? esc($settings['smtp_host']) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="smtp_user">SMTP User</label>
                                                            <input type="email" class="form-control" name="smtp_user" id="smtp_user" value="<?= isset($settings['smtp_user']) ? esc($settings['smtp_user']) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="smtp_pass">SMTP Password</label>
                                                            <input type="password" class="form-control" name="smtp_pass" id="smtp_pass" value="<?= isset($settings['smtp_pass']) ? esc($settings['smtp_pass']) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="smtp_protocol">SMTP Protocol</label>
                                                            <input type="text" class="form-control" name="smtp_protocol" id="smtp_protocol" value="<?= isset($settings['smtp_protocol']) ? esc($settings['smtp_protocol']) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="smtp_port">SMTP Port</label>
                                                            <input type="text" class="form-control" name="smtp_port" id="smtp_port" value="<?= isset($settings['smtp_port']) ? esc($settings['smtp_port']) : '' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-flat btn-primary">Perbarui</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="pengaturanCaptcha" role="tabpanel" aria-labelledby="pengaturanCaptcha-tab">
                                    <div class="card">
                                        <?php if (session()->getFlashdata('success')) : ?>
                                            <div class="alert alert-success m-3">
                                                <?= session()->getFlashdata('success') ?>
                                            </div>
                                        <?php endif; ?>
                                        <form action="<?= base_url('admin_v2/update_captcha') ?>" method="POST">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="google_recaptcha_sitekey">Site Key</label>
                                                            <input type="text" class="form-control" name="google_recaptcha_sitekey" id="google_recaptcha_sitekey" value="<?= isset($settings['google_recaptcha_sitekey']) ? esc($settings['google_recaptcha_sitekey']) : '' ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="google_recaptcha_secretkey">Secret Key</label>
                                                            <input type="text" class="form-control" name="google_recaptcha_secretkey" id="google_recaptcha_secretkey" value="<?= isset($settings['google_recaptcha_secretkey']) ? esc($settings['google_recaptcha_secretkey']) : '' ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-flat btn-primary">Perbarui</button>
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

<?= $this->endSection() ?>