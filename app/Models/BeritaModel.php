<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'informasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kategori', 'judul', 'isi', 'tags', 'tgl_publikasi', 'gambar', 'status', 'slug', 'users_id'];

    public function insertBerita($data)
    {
        return $this->insert($data);
    }
}
