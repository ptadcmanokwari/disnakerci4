<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FrontendModel;

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

    public function berita_ajax()
    {
        $model = new FrontendModel();

        $request = \Config\Services::request();
        $draw = $request->getPost('draw') ?? 1;
        $start = (int) $request->getPost('start') ?? 0;
        $length = (int) $request->getPost('length') ?? 10;
        $searchValue = $request->getPost('search')['value'] ?? '';

        // Total records
        $totalRecords = $model->countAllResults();

        // Filtered records
        if (!empty($searchValue)) {
            $model->like('judul', $searchValue)
                ->orLike('isi', $searchValue);
        }
        $totalFiltered = $model->countAllResults(false);

        // Fetch data
        if (!empty($searchValue)) {
            $model->like('judul', $searchValue)
                ->orLike('isi', $searchValue);
        }
        $model->limit($length, $start);
        $berita = $model->find();

        $data = [];
        foreach ($berita as $row) {
            $data[] = [
                'judul' => $row['judul'],
                'isi' => $row['isi'],
                'kategori' => $row['kategori'],
                'gambar' => $row['gambar'],
                'id' => $row['id'],
            ];
        }

        return $this->response->setJSON([
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalFiltered,
            'data' => $data
        ]);
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
