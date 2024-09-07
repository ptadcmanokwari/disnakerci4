<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table = 'pendidikan_pencaker';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_sekolah',
        'tahunmasuk',
        'tahunlulus',
        'ipk',
        'keterampilan',
        'pencaker_id',
        'jenjang_pendidikan_id'
    ];

    public function getPendidikanStatistik()
    {
        $query = $this->db->query("SELECT jp.jenjang, (SELECT COUNT(pd.id) FROM pendidikan_pencaker pd WHERE pd.jenjang_pendidikan_id=jp.id) AS total FROM jenjang_pendidikan jp");
        return $query->getResult();
    }

    public function getPendidikanByPencakerId($pencakerId)
    {
        return $this->select('pendidikan_pencaker.*, jenjang_pendidikan.jenjang')
            ->join('jenjang_pendidikan', 'pendidikan_pencaker.jenjang_pendidikan_id = jenjang_pendidikan.id', 'left')
            ->where('pendidikan_pencaker.pencaker_id', $pencakerId)
            ->orderBy('jenjang_pendidikan.id', 'ASC')
            ->findAll();
    }
}
