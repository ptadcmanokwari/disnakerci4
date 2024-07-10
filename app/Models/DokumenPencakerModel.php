<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenPencakerModel extends Model
{
    protected $table = 'pencaker_dokumen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['namadokumen', 'tgl_upload', 'pencaker_id', 'dokumen_id'];
}
