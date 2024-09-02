<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id';
    protected $allowedFields = ['deskripsi', 'gambar', 'kategori', 'status', 'created_at', 'updated_at'];

    public function getUniqueCategories()
    {
        return $this->distinct()->findColumn('kategori');
    }
}
