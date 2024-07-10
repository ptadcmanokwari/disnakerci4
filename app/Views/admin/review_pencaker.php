<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Review Data dan Dokumen Pencaker</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4;
        }
    </style>
    <style type="text/css">
        * {
            font-size: 12px;
        }

        td,
        tr,
        th {
            padding: 0 !important;
            margin: 0 !important;
        }

        h4 {
            padding: 0 !important;
            font-size: 16px;
            margin: 0 !important;
            font-weight: bold;
        }

        .div1 {
            width: 100%;
            height: 60px;
            border: 1px solid gray;
        }

        ul.bahasa li {
            display: inline;
            padding-right: 20px;
        }

        .table-bordered>:not(caption)>* {
            border-width: 1px 0;
            vertical-align: middle;
            text-align: center;
        }

        ul.bahasa {
            padding-left: 0;
        }

        img.float-end {
            object-fit: cover;
        }
    </style>
</head>

<body class="A4">

    <section class="sheet padding-10mm">

        <div class="row">
            <div class="col-2 border-bottom">
                <img width="70" height="70" src="<?php echo base_url('frontend/assets/img/favicon/android-chrome-512x512.png'); ?>">
            </div>
            <div class="col-10 border-bottom">
                <h2 class="text-medium">PEMERINTAH KABUPATEN MANOKWARI<br>DINAS TENAGA KERJA DAN TRANSMIGRASI</h2>
                <p class="text-small">Jalan Percetakan Negara No. 7 Manokwari Papua Barat</p>
            </div>
        </div>

        <hr>

        <div class="col-12 border-bottom">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td width="30%">NOMOR PENDAFTARAN</td>
                        <td width="2%">:</td>
                        <td class="fw-bold" width="68%"><?php echo $pencaker['nopendaftaran']; ?></td>
                    </tr>
                    <tr>
                        <td>TANGGAL PENDAFTARAN</td>
                        <td>:</td>
                        <td class="fw-bold"><?php echo $pencaker['agama']; ?></td>
                    </tr>
                    <tr>
                        <td>NOMOR INDUK KEPENDUDUKAN</td>
                        <td>:</td>
                        <td class="fw-bold"><?php echo $pencaker['nik']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>

        <div class="col-12 border-bottom">
            <div class="row">
                <div class="col-8">
                    <h4>KETERANGAN UMUM</h4>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td width="30%">Nama Lengkap</td>
                                <td width="2%">:</td>
                                <td width="68%" class="fw-bold"><?php echo strtoupper($pencaker['namalengkap']); ?></td>
                            </tr>
                            <tr>
                                <td>Tempat, Tanggal Lahir</td>
                                <td>:</td>
                                <td class="fw-bold">
                                    <?php echo strtoupper($pencaker['tempatlahir']) . ", " . strtoupper($pencaker['tgllahir']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tinggi Badan</td>
                                <td>:</td>
                                <td class="fw-bold"><?php echo $pencaker['tinggibadan'] . " CM"; ?></td>
                            </tr>
                            <tr>
                                <td>Berat Badan</td>
                                <td>:</td>
                                <td class="fw-bold"><?php echo $pencaker['beratbadan'] . " KG"; ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td class="fw-bold"><?php echo ($pencaker['jenkel'] == 'L') ? 'LAKI-LAKI' : 'PEREMPUAN'; ?></td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td class="fw-bold"><?php echo strtoupper($pencaker['agama']); ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td class="fw-bold"><?php echo strtoupper($pencaker['alamat']); ?></td>
                            </tr>
                            <tr>
                                <td>Nomor HP</td>
                                <td>:</td>
                                <td class="fw-bold"><?php echo $pencaker['agama']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td class="fw-bold"><?php echo $pencaker['agama']; ?></td>
                            </tr>
                            <tr>
                                <td>Kode Pos</td>
                                <td>:</td>
                                <td class="fw-bold"><?php echo $pencaker['kodepos']; ?></td>
                            </tr>
                            <tr>
                                <td>Status Pernikahan</td>
                                <td>:</td>
                                <td class="fw-bold"><?php echo strtoupper($pencaker['statusnikah']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-2 ms-auto">
                    <?php
                    // Path ke gambar yang disimpan
                    $image_path = 'uploads/pencaker/' . $pencaker['id'] . '.jpg'; // atau sesuaikan ekstensi file gambarnya

                    // Cek apakah file gambar ada
                    if (file_exists(FCPATH . $image_path)) {
                        $image_url = base_url($image_path);
                    } else {
                        // Path ke gambar default
                        $image_url = base_url('uploads/pencaker/default.webp'); // pastikan gambar default ada di direktori yang benar
                    }
                    ?>
                    <img class="float-end" src="<?php echo $image_url; ?>" height="200px" width="160px">
                </div>
            </div>
        </div>

        <hr>

        <div class="col-12 border-bottom">
            <h4>PENDIDIKAN FORMAL</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10px" style="padding: 3px !important;">No</th>
                        <th>Tahun Masuk</th>
                        <th>Tahun Lulus</th>
                        <th>Jenjang</th>
                        <th>Nama Satuan Pendidikan</th>
                        <th>NEM/NUN/IPK</th>
                        <th>Keterampilan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pendidikan as $pd) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $pd['tahunmasuk']; ?></td>
                            <td><?php echo $pd['tahunlulus']; ?></td>
                            <td><?php echo $pd['jenjang']; ?></td>
                            <td><?php echo $pd['nama_sekolah']; ?></td>
                            <td><?php echo $pd['ipk']; ?></td>
                            <td><?php echo $pd['keterampilan']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <hr>

        <div class="col-12 border-bottom">
            <h4>BAHASA YANG DIKUASAI</h4>
            <ul class="bahasa">
                <?php
                $ket_bahasa = explode(',', $pencaker['keterampilan_bahasa'] ?? '');
                $bahasa_lainnya = explode(',', $pencaker['bahasa_lainnya'] ?? '');
                $urut = 1;

                foreach (array_filter($ket_bahasa) as $kb) {
                    echo '<li>' . $urut++ . '. ' . strtoupper($kb) . '</li>';
                }

                foreach (array_filter($bahasa_lainnya) as $bl) {
                    echo '<li>' . $urut++ . '. ' . strtoupper($bl) . '</li>';
                }
                ?>
            </ul>
        </div>

        <hr>

        <div class="col-12 border-bottom">
            <h4>PENGALAMAN KERJA</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="10px" style="padding: 3px !important;">No</th>
                        <th>Nama Perusahaan</th>
                        <th>Posisi Terakhir</th>
                        <th>Pendapatan Terakhir</th>
                        <th>Periode</th>
                        <th>Alasan Berhenti</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pengalaman as $pk) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $pk['nama_perusahaan']; ?></td>
                            <td><?php echo $pk['posisi_terakhir']; ?></td>
                            <td><?php echo $pk['pendapatan_terakhir']; ?></td>
                            <td><?php echo $pk['periode']; ?></td>
                            <td><?php echo $pk['alasan_berhenti']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <hr>

        <div class="col-12">
            <h4>DOKUMEN</h4>
            <div class="div1">
                <?php

                foreach ($dokumen as $dp) :
                    if ($dp['namadokumen'] != null && $dp['jenis_dokumen'] != 'PAS FOTO') {
                ?>
                        <?php
                        $url = base_url('uploads/pencaker/') . $dp['nopendaftaran'] . '/' . $dp['namadokumen'];
                        $url = parse_url($url);
                        $ext  = pathinfo($url['path'], PATHINFO_EXTENSION);
                        if ($ext == 'pdf') {
                        ?>
                            <iframe src="<?php echo base_url('uploads/pencaker/') . $dp['nopendaftaran'] . '/' . $dp['namadokumen']; ?>" frameborder="0" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:0px;left:0px;right:0px;bottom:0px" height="100%" width="100%"></iframe>

                        <?php } else { ?>

                            <img class="tex-center" src="<?php echo base_url('uploads/pencaker/') . $dp['nopendaftaran'] . '/' . $dp['namadokumen']; ?>" width="80%">
                        <?php } ?>
                <?php
                    }
                endforeach;

                ?>
            </div>
        </div>
    </section>
</body>

</html>