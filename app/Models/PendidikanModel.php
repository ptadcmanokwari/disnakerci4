<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table = 'pendidikan_pencaker';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_sekolah', 'tahunmasuk', 'tahunlulus', 'ipk', 'keterampilan', 'pencaker_id', 'jenjang_pendidikan_id'
    ];

    public function getPendidikanStatistik()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT jp.jenjang, (SELECT COUNT(pd.id) FROM pendidikan_pencaker pd WHERE pd.jenjang_pendidikan_id=jp.id) AS total FROM jenjang_pendidikan jp");
        return $query->getResult();
    }
}
