<?php

namespace App\Models;

use CodeIgniter\Model;

class PerusahaanModel extends Model
{
    protected $table = 'perusahaan_tujuan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_perusahaan', 'nohp_perusahaan', 'alamat_perusahaan', 'pencaker_id'];
}
