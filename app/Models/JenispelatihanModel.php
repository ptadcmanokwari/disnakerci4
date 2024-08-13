<?php

namespace App\Models;

use CodeIgniter\Model;

class JenispelatihanModel extends Model
{
    protected $table = 'jenis_pelatihan';
    protected $primaryKey = 'kode';
    protected $allowedFields = ['pelatihan'];
}
