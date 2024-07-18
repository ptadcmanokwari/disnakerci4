<?php

namespace App\Models;

use CodeIgniter\Model;

class BahasaModel extends Model
{
    protected $table = 'keterampilan_bahasa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'bahasa'];
}
