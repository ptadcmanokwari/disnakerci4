<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

// Controller untuk admin (org Disnakertrans)
class Admin extends BaseController
{
    public function index()
    {
        return $this->loadView('be_admin/dashboard');
    }

    public function dashboard()
    {
        return $this->loadView('be_admin/dashboard');
    }

    public function pencaker()
    {
        return $this->loadView('be_admin/pencaker');
    }

    public function berita()
    {
        return $this->loadView('be_admin/berita');
    }

    public function pengumuman()
    {
        return $this->loadView('be_admin/pengumuman');
    }

    public function pelatihan()
    {
        return $this->loadView('be_admin/pelatihan');
    }

    public function userslog()
    {
        return $this->loadView('be_admin/userslog');
    }

    public function users()
    {
        return $this->loadView('be_admin/users');
    }

    public function settings()
    {
        return $this->loadView('be_admin/settings');
    }

    public function backup()
    {
        return $this->loadView('be_admin/backup');
    }

    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI

        return view($viewName, $data);
    }
}