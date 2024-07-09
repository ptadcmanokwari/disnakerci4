<?php
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle('DATA PENCARI KERJA');
$pdf->SetHeaderMargin(20);
$pdf->SetTopMargin(10);
$pdf->setFooterMargin(15);
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetAuthor('Author');
$pdf->SetDisplayMode('real', 'default');
// $pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);
$pdf->SetMargins(5, 10, 5, true);

$pdf->AddPage('L', 'A4');
$html = '
<style>
    table{
        font-size:7;
        margin-left: auto;
        margin-right: auto;
    }
    tr.center{
        text-align:center;
        background-color:#C0C0C0;
        font-weight: bold;
    }
    div.heading{
        text-align:center;
        font-weight:bold;
        font-size:10;
    }

    div.small {
        font-size:7;
        padding-bottom:5px;
    }

    div.mb-2 {
        fs-size:7;
        color: #fff;
    }

    @media print {
        img {
            width: 150px;
            height: 150px;
            max-height: 150px;
            object-fit: cover;
        }
    }
    
</style>
<div class="heading">DATA PENCARI KERJA KABUPATEN MANOKWARI</div>
<div class="small"></div><br>
<table width="100%" border="1" cellpadding="5">
    <tr class="center">
        <th width="22">No.</th>
        <th width="80">Nama Lengkap</th>
        <th width="19">JK</th>
        <th width="82">Nomor Pendaftaran</th>
        <th width="80">NIK</th>
        <th width="40">Agama</th>
        <th width="70">Alamat</th>
        <th width="100">Tempat,<br> Tgl. Lahir</th>
        <th width="40">Status<br> Menikah</th>
        <th width="30">Kode Pos</th>
        <th width="22">TB</th>
        <th width="22">BB</th>
        <th width="25">LJ</th>
        <th width="60">Tujuan<br>Perusahaan</th>
        <th width="60">Keterampilan<br>Bahasa</th>
        <th width="60">Bahasa<br> Lainnya</th>
    </tr>';
$no = 1;
foreach ($pencari_kerja as $pk) {
    $html .= '<tr>
        <td align="center">' . $no . '</td>
        <td align="center">' . $pk->namalengkap . '</td>
        <td align="center">' . $pk->jenkel . '</td>
        <td align="center">' . $pk->nopendaftaran . '</td>
        <td align="center">' . $pk->nik . '</td>
        <td align="center">' . $pk->agama . '</td>
        <td align="center">' . $pk->alamat . '</td>
        <td align="center">' . $pk->tempatlahir . ', ' . date('d F Y', strtotime($pk->tgllahir)) . '</td>
        <td align="center">' . $pk->statusnikah . '</td>
        <td align="center">' . $pk->kodepos . '</td>
        <td align="center">' . $pk->tinggibadan  . '</td>
        <td align="center">' . $pk->beratbadan . '</td>
        <td align="center">' . $pk->lokasi_jabatan . '</td>
        <td align="center">' . $pk->tujuan_perusahaan . '</td>
        <td align="center">' . $pk->keterampilan_bahasa . '</td>
        <td align="center">' . $pk->bahasa_lainnya . '</td>
    </tr>';
    $no++;
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('DATA PENCARI KERJA KABUPATEN MANOKWARI.pdf', 'I');
