<?php

namespace App\Models;

use CodeIgniter\Model;

class PencakerModel extends Model
{
    protected $table = 'pencaker';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'namalengkap', 'tgllahir', 'alamat', 'jeniskelamin', 'status', 'telepon', 'email', 'foto', 'jenjang_pendidikan_id'
    ];

    public function getUmurStatistik()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT (YEAR(CURDATE())-YEAR(tgllahir)) AS umur, COUNT((YEAR(CURDATE())-YEAR(tgllahir))) AS jumlah FROM pencaker GROUP BY umur ORDER BY umur ASC");
        return $query->getResult();
    }

    public function countPencaker()
    {
        return $this->countAll();
    }
}
