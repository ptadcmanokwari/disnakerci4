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

    // Method untuk menyimpan data pencaker
    public function savePencaker($data)
    {
        return $this->insert($data);
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
}
