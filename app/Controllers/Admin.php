<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FrontendModel;
use App\Models\BeritaModel;

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
        $totalRecords = $model->countInformasiByKategori('berita');

        // Filtered records
        if (!empty($searchValue)) {
            $model->like('judul', $searchValue)
                ->orLike('isi', $searchValue)
                ->where('kategori', 'berita');
        } else {
            $model->where('kategori', 'berita');
        }
        $totalFiltered = $model->countAllResults(false);

        // Fetch data
        if (!empty($searchValue)) {
            $model->like('judul', $searchValue)
                ->orLike('isi', $searchValue)
                ->where('kategori', 'berita');
        } else {
            $model->where('kategori', 'berita');
        }
        $model->limit($length, $start);
        $berita = $model->find();

        $data = [];
        foreach ($berita as $row) {
            $data[] = [
                'judul' => $row['judul'],
                'isi' => $row['isi'],
                'gambar' => $row['gambar'],
                'status' => $row['status'],
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

    public function uploadBerita()
    {
        // Validasi input jika diperlukan
        $request = service('request');

        // Menggunakan dependency injection untuk memanggil model
        $model = new BeritaModel();

        $data = [
            'kategori' => $request->getVar('kategori'),
            'judul' => $request->getVar('judul'),
            'isi' => $request->getVar('isi'),
            'tags' => $request->getVar('tags'),
            'tgl_publikasi' => date('Y-m-d H:i:s'), // Misalnya tanggal saat ini
            'status' => $request->getVar('status'),
            'users_id' => $request->getVar('users_id'),
            'gambar' => $request->getVar('gambar') // File gambar akan di-handle terpisah
        ];

        // Insert data berita ke database
        $insertedId = $model->insert($data);

        if ($insertedId) {
            echo json_encode(['status' => 'success', 'message' => 'Berita berhasil diunggah!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengunggah berita.']);
        }
    }


    public function get_berita($id)
    {
        $model = new FrontendModel();
        $berita = $model->find($id);

        if (!$berita) {
            return $this->response->setJSON(['error' => 'Berita tidak ditemukan.']);
        }

        return $this->response->setJSON($berita);
    }
    // $users_id = $this->session->get('id'); 

    private function slugify($str)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $str)));
        return $slug;
    }

    public function upload_gambar()
    {
        if ($this->request->getFile('file')->isValid()) {
            $file = $this->request->getFile('file');
            $fileName = $file->getRandomName();
            $file->move('uploads/berita/', $fileName);

            return $this->response->setJSON([
                'success' => true,
                'filename' => $fileName,
                'filepath' => base_url('uploads/berita/' . $fileName)
            ]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function update_berita()
    {
        $model = new FrontendModel();
        $id = $this->request->getPost('id');
        $kategori = $this->request->getPost('kategori');
        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $tags = $this->request->getPost('tags');
        $status = $this->request->getPost('status');
        $users_id = $this->request->getPost('users_id');

        // Fungsi untuk membuat slug dari judul
        $slug = $this->slugify($judul);

        // Buat array data berdasarkan input dari form
        $data = [
            'kategori' => $kategori,
            'judul' => $judul,
            'isi' => $isi,
            'tags' => $tags,
            'status' => $status,
            'tgl_publikasi' => date("Y-m-d H:i:s"), // Tanggal publikasi diupdate saat ini
            'users_id' => $users_id,
            'slug' => $slug
        ];

        // Pengecekan apakah file gambar diunggah
        $gambar = $this->request->getPost('gambar');
        if ($gambar) {
            // Hapus gambar lama jika ada
            $oldImagePath = 'uploads/berita/' . $gambar;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $data['gambar'] = $this->request->getPost('gambar'); // Masukkan nama file ke dalam data untuk disimpan di database
        }

        // Panggil model untuk melakukan update berita
        if ($model->update($id, $data)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }


    public function hapus_berita()
    {
        $response = ['success' => false];

        $request = \Config\Services::request();
        $id = $request->getPost('id');

        if ($id) {
            $model = new FrontendModel();
            if ($model->delete($id)) {
                $response['success'] = true;
            }
        }

        return $this->response->setJSON($response);
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
