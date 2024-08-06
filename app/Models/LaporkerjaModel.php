<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporkerjaModel extends Model
{
    protected $table = 'lapor_kerja';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_perusahaan', 'bidang_perusahaan', 'jabatan', 'no_telp', 'alamat', 'lapor_pencaker_id'];
}
