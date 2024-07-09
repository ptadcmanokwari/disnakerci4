<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use App\Models\PencakerModel;


class Excel extends Controller
{
    public function exportExcel()
    {
        $pencakerModel = new PencakerModel();
        $dataPencaker = $pencakerModel->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Tambahkan logo
        $logoPath = FCPATH . 'frontend/assets/img/logodisnakertransmkw.png';
        if (file_exists($logoPath)) {
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Logo');
            $drawing->setDescription('Logo');
            $drawing->setPath($logoPath);
            $drawing->setHeight(50);
            $drawing->setCoordinates('A1');
            $drawing->setWorksheet($sheet);
        }

        // Set title
        $sheet->setCellValue('A2', 'DATA PENCARI KERJA KABUPATEN MANOKWARI');
        $sheet->mergeCells('A2:P2');
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A2')->getFont()->setSize(16);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tambahkan header kolom
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama Lengkap');
        $sheet->setCellValue('C4', 'JK');
        $sheet->setCellValue('D4', 'Nomor Pendaftaran');
        $sheet->setCellValue('E4', 'NIK');
        $sheet->setCellValue('F4', 'Agama');
        $sheet->setCellValue('G4', 'Alamat');
        $sheet->setCellValue('H4', 'Tempat, Tgl. Lahir');
        $sheet->setCellValue('I4', 'Status Menikah');
        $sheet->setCellValue('J4', 'Kode Pos');
        $sheet->setCellValue('K4', 'TB');
        $sheet->setCellValue('L4', 'BB');
        $sheet->setCellValue('M4', 'LJ');
        $sheet->setCellValue('N4', 'Tujuan Perusahaan');
        $sheet->setCellValue('O4', 'Keterampilan');
        $sheet->setCellValue('P4', 'Bahasa Lainnya');

        // Format header kolom
        $headerStyle = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'ECF0F6']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => '000000']]],
        ];
        $sheet->getStyle('A4:P4')->applyFromArray($headerStyle);

        // Atur tinggi baris untuk header
        $sheet->getRowDimension(4)->setRowHeight(22);

        // Atur tinggi baris untuk data
        $row = 5;
        foreach ($dataPencaker as $pencaker) {
            $sheet->getRowDimension($row)->setRowHeight(20);
            $row++;
        }

        // Isi data
        $row = 5;
        $no = 1;
        foreach ($dataPencaker as $pencaker) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, ucwords(strtolower($pencaker['namalengkap'])));
            $sheet->setCellValue('C' . $row, $pencaker['jenkel']);
            $sheet->setCellValueExplicit('D' . $row, $pencaker['nopendaftaran'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('E' . $row, $pencaker['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('F' . $row, $pencaker['agama']);
            $sheet->setCellValue('G' . $row, $pencaker['alamat']);
            $sheet->setCellValue('H' . $row, $pencaker['tempatlahir'] . ', ' . $pencaker['tgllahir']);
            $sheet->setCellValue('I' . $row, $pencaker['statusnikah']);
            $sheet->setCellValue('J' . $row, $pencaker['kodepos']);
            $sheet->setCellValue('K' . $row, $pencaker['tinggibadan'] . ' CM');
            $sheet->setCellValue('L' . $row, $pencaker['beratbadan'] . ' KG');
            $sheet->setCellValue('M' . $row, $pencaker['lokasi_jabatan']);
            $sheet->setCellValue('N' . $row, $pencaker['tujuan_perusahaan']);
            $sheet->setCellValue('O' . $row, $pencaker['keterampilan_bahasa']);
            $sheet->setCellValue('P' . $row, $pencaker['bahasa_lainnya']);

            // Atur alignment untuk data
            $sheet->getStyle('A' . $row . ':P' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A' . $row . ':P' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

            // Wrap text di setiap sel
            foreach (range('A', 'P') as $col) {
                $sheet->getStyle($col . $row)->getAlignment()->setWrapText(true);
            }

            $row++;
        }

        // Atur lebar kolom
        $sheet->getColumnDimension('A')->setWidth(5); // No
        $sheet->getColumnDimension('B')->setWidth(25); // Nama Lengkap
        $sheet->getColumnDimension('C')->setWidth(5); // JK
        $sheet->getColumnDimension('D')->setWidth(20); // Nomor Pendaftaran
        $sheet->getColumnDimension('E')->setWidth(20); // NIK
        $sheet->getColumnDimension('F')->setWidth(15); // Agama
        $sheet->getColumnDimension('G')->setWidth(30); // Alamat
        $sheet->getColumnDimension('H')->setWidth(25); // Tempat, Tgl. Lahir
        $sheet->getColumnDimension('I')->setWidth(15); // Status Menikah
        $sheet->getColumnDimension('J')->setWidth(10); // Kode Pos
        $sheet->getColumnDimension('K')->setWidth(10); // TB
        $sheet->getColumnDimension('L')->setWidth(10); // BB
        $sheet->getColumnDimension('M')->setWidth(20); // LJ
        $sheet->getColumnDimension('N')->setWidth(30); // Tujuan Perusahaan
        $sheet->getColumnDimension('O')->setWidth(30); // Keterampilan
        $sheet->getColumnDimension('P')->setWidth(30); // Bahasa Lainnya

        // Set nama file dan atur header untuk mengunduh file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_pencaker.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
        $writer->save('php://output');
        exit;
    }
}
