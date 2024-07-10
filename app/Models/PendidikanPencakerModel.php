<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanPencakerModel extends Model
{
    protected $table = 'pendidikan_pencaker';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_sekolah', 'tahunmasuk', 'tahunlulus', 'ipk', 'keterampilan', 'pencaker_id', 'jenjang_pendidikan_id'];
}
