<?php

namespace App\Models;

use CodeIgniter\Model;

class VerifikasiModel extends Model
{
    protected $table = 'verifikasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tglwaktu', 'pesan', 'users_id', 'status_pesan'];
}
