<?php

namespace App\Models;

use CodeIgniter\Model;

class PencakerModel extends Model
{
    protected $table = 'pencaker';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'namalengkap', 'tempatlahir', 'tgllahir', 'jenkel', 'alamat', 'kodepos', 'statusnikah', 'tinggibadan', 'beratbadan',
        'agama', 'nik', 'nopendaftaran', 'tujuan', 'lokasi_jabatan', 'tujuan_perusahaan', 'catatan_pengantar', 'keterampilan_bahasa',
        'bahasa_lainnya', 'keterangan_status', 'qr_code', 'users_id'
    ];

    public function savePencaker($data)
    {
        return $this->save($data); // Menyimpan data dengan menggunakan metode save
    }

    // Contoh method tambahan untuk mengambil statistik umur pencaker
    public function getUmurStatistik()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT (YEAR(CURDATE())-YEAR(tgllahir)) AS umur, COUNT((YEAR(CURDATE())-YEAR(tgllahir))) AS jumlah FROM pencaker GROUP BY umur ORDER BY umur ASC");
        return $query->getResult();
    }

    // Contoh method tambahan untuk menghitung jumlah pencaker
    public function countPencaker()
    {
        return $this->countAll();
    }

    public function countByStatus($status)
    {
        return $this->where('keterangan_status', $status)->countAllResults();
    }

    public function countByPendidikan()
    {
        return $this->db->table('pendidikan_pencaker')
            ->select('jenjang_pendidikan.jenjang AS pendidikan_terakhir, COUNT(*) AS jumlah')
            ->join('jenjang_pendidikan', 'pendidikan_pencaker.jenjang_pendidikan_id = jenjang_pendidikan.id')
            ->groupBy('jenjang_pendidikan.jenjang')
            ->get()
            ->getResultArray();
    }

    public function countByUsia()
    {
        return $this->select("CASE
                                WHEN YEAR(CURDATE()) - YEAR(tgllahir) BETWEEN 18 AND 25 THEN '18-25'
                                WHEN YEAR(CURDATE()) - YEAR(tgllahir) BETWEEN 26 AND 35 THEN '26-35'
                                WHEN YEAR(CURDATE()) - YEAR(tgllahir) BETWEEN 36 AND 45 THEN '36-45'
                                WHEN YEAR(CURDATE()) - YEAR(tgllahir) > 45 THEN '46+'
                              END AS rentang_usia, COUNT(*) AS jumlah")
            ->groupBy('rentang_usia')
            ->findAll();
    }

    public function getPencakerByGenderAndMonth($year)
    {
        $query = $this->db->query("
            SELECT MONTH(tgllahir) AS bulan, jenkel, COUNT(*) AS jumlah
            FROM pencaker
            WHERE YEAR(tgllahir) = ?
            GROUP BY MONTH(tgllahir), jenkel
            ORDER BY MONTH(tgllahir)
        ", [$year]);

        return $query->getResult();
    }
}
