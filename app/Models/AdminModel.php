<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'users'; // Contoh nama tabel

    // Fungsi untuk mendapatkan semua data pengguna
    public function getUsers()
    {
        return $this->findAll();
    }

    // Fungsi lain seperti CRUD bisa ditambahkan di sini
}
