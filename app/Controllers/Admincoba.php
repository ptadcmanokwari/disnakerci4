<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admincoba extends Controller
{
    public function index()
    {
        // Load view admin/dashboard.php
        return view('admin/dashboard');
    }

    public function users()
    {
        // Load view admin/users.php
        return view('admin/users');
    }

    // Tambahkan fungsi lain sesuai kebutuhan, seperti CRUD untuk pengelolaan data
}
