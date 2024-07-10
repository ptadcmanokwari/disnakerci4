<?php

namespace App\Models;

use CodeIgniter\Model;

class PengalamanKerjaModel extends Model
{
    protected $table = 'pengalaman_kerja';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'tahunmasuk', 'tahunkeluar', 'jabatan', 'pencaker_id'];
}
