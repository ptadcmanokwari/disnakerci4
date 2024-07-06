<?php

namespace App\Models;

use CodeIgniter\Model;

class JenjangpendidikanModel extends Model
{
    protected $table = 'jenjang_pendidikan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['jenjang'];
}
