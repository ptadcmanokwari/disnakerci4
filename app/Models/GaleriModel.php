<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id';
    protected $allowedFields = ['deskripsi', 'gambar', 'kategori', 'status', 'halaman', 'created_at', 'updated_at'];

    public function getUniqueCategories()
    {
        return $this->distinct()->findColumn('kategori');
    }

    public function getGalleriesForHome()
    {
        return $this->where('halaman', 'beranda')
            ->where('status', 1) // Misalkan hanya menampilkan galeri yang aktif
            ->findAll();
    }

    public function getGalleriesForTransmigrasi()
    {
        return $this->where('halaman', 'transmigrasi')
            ->where('status', 1) // Misalkan hanya menampilkan galeri yang aktif
            ->findAll();
    }

    public function getGalleriesForTenagakerja()
    {
        return $this->where('halaman', 'tenaga_kerja')
            ->where('status', 1) // Misalkan hanya menampilkan galeri yang aktif
            ->findAll();
    }
}
