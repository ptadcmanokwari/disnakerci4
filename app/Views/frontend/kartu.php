<!DOCTYPE html>
<html>

<head>
    <title>Kartu Pencari Kerja</title>
</head>

<body>
    <h1>Kartu Pencari Kerja</h1>
    <p>Nama: <?= $pencari_kerja['namalengkap'] ?></p>
    <p>NIK: <?= $pencari_kerja['nik'] ?></p>
    <p>Status Pekerjaan: <?= $pencari_kerja['keterangan_status'] ?></p>
    <img src="<?= $qr_code ?>" alt="QR Code">
</body>

</html>