<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page->title ?></title>
</head>

<body>
    <h1><?= $page->title ?></h1>
    <p><?= $v_msg->valid ?></p>
    <?php if ($v_msg->code) : ?>
        <p>Nama Lengkap: <?= $v_msg->pencaker->namalengkap ?></p>
        <p>No Pendaftaran: <?= $v_msg->pencaker->nopendaftaran ?></p>
        <p>Tanggal Aktif: <?= $v_msg->pencaker->tglaktifpencaker ?></p>
    <?php endif; ?>
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">
            <br><br>
            <div class="section-title">
                <h2>KARTU PENCARI KERJA</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <?php if ($v_msg->code == TRUE) { ?>
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                            <div class="pic"><img src="<?php echo base_url('uploads/pencaker/') . $v_msg->pencaker->nopendaftaran . '/' . $v_msg->pencaker->namadokumen; ?>" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4><?php echo strtoupper($v_msg->pencaker->namalengkap); ?></h4>
                                <span>Aktif Sebagai Pencari Kerja Sejak <?php echo (!empty($v_msg->pencaker->tglaktifpencaker)) ? date($v_msg->pencaker->tglaktifpencaker) : ''; ?></span>
                                <p>Status Pekerjaan Saat Ini : </p>
                                <p>Status Pelaporan : </p>
                                <div class="social">
                                    <a href="tel:<?php echo $v_msg->pencaker->phone; ?>"><i class="ri-phone-fill"></i></a>
                                    <a target="_blank" href="https://wa.me/<?php echo $v_msg->pencaker->phone; ?>"><i class="ri-whatsapp-fill"></i></a>
                                    <a href="mailto:<?php echo $v_msg->pencaker->email; ?>"><i class="ri-mail-fill"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                            <div class="member-info">
                                <div class="text-center">
                                    <h4><?php echo $v_msg->valid; ?></h4>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</body>

</html>