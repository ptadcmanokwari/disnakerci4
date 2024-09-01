<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id';
    protected $allowedFields = ['deskripsi', 'gambar', 'kategori', 'status', 'created_at', 'updated_at'];

    public function getGaleri()
    {
        return $this->select('MAX(id) as id, kategori, MAX(deskripsi) as deskripsi, GROUP_CONCAT(gambar SEPARATOR ",") as gambar, MAX(status) as status')
            ->groupBy('kategori')
            ->findAll();
    }

    public function getGroupedGaleri()
    {
        return $this->select('MIN(id) as id, deskripsi, kategori, GROUP_CONCAT(gambar) as gambar, status')
            ->groupBy('kategori')
            ->findAll();
    }

    public function getUniqueCategories()
    {
        return $this->distinct()->findColumn('kategori');
    }
}
