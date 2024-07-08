<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use CodeIgniter\HTTP\ResponseInterface;
use App\Models\FrontendModel;
use App\Models\BeritaModel;
use CodeIgniter\HTTP\URI;
use CodeIgniter\API\ResponseTrait;

class Admin_v2 extends BaseController
{

    public function index()
    {
        return $this->loadView('admin/dashboard');
    }

    public function pencaker()
    {
        return $this->loadView('admin/pencaker');
    }

    use ResponseTrait;
    public function berita()
    {
        $model = new FrontendModel();
        $data['berita'] = $model->getInformasiByKategori('berita', 10, 0); // Ambil 10 data berita pertama

        // Mendefinisikan variabel $current_uri
        $uri = new URI(current_url());
        $data['current_uri'] = $uri->getPath();

        return view('admin/beritama', $data);
    }

    public function beritaajax()
    {
        $beritaModel = new FrontendModel();
        $berita = $beritaModel->getInformasiByKategori('berita', 10, 0);

        $data = [];
        $no = 1;
        foreach ($berita as $item) {
            $gambar = '<img src="' . base_url('/public/uploads/berita/' . esc($item['gambar'])) . '" alt="' . esc($item['judul']) . '" width="100">';
            $gambar = htmlspecialchars_decode($gambar);

            $data[] = [
                "no" => $no++,
                "judul" => $item['judul'],
                "isi" => $item['isi'],
                "gambar" => $gambar,
                "status" => '<input type="checkbox" class="js-switch" data-id="' . $item['id'] . '" ' . ($item['status'] ? 'checked' : '') . '>',
                "aksi" =>
                '<div class="btn-group" role="group" aria-label="Aksi">
                        <a href="' . base_url('admin/detail_berita/' . $item['id']) . '" class="btn btn-info btn-sm mx-1">
                            <i class="bi bi-eye px-2"></i>
                        </a>
                                <button class="btn btn-warning btn-sm btn-edit mx-1" 
        data-edit_id="' . $item['id'] . '" 
        data-edit_judul="' . htmlspecialchars($item['judul']) . '" 
        data-edit_isi="' . htmlspecialchars($item['isi']) . '" 
        data-edit_tags="' . $item['tags'] . '" 
        data-edit_gambar="' . $item['gambar'] . '" 
        data-toggle="modal"  data-toggle="modal" 
        data-target="#ubahBeritaBaruModal">
    <i class="bi bi-pencil-square px-2"></i>
    </button>
                        <button class="btn btn-danger btn-sm btn-delete mx-1" data-id="' . $item['id'] . '">
                            <i class="bi bi-trash px-2"></i>
                        </button>
                    </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function update_status_berita()
    {
        $id = $this->request->getJSON()->id;
        $status = $this->request->getJSON()->status;

        $model = new FrontendModel();
        $update = $model->update($id, ['status' => $status]);

        if ($update) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }


    public function save_berita()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'kategori' => 'required|max_length[255]',
            'file' => 'uploaded[file]|is_image[file]',
            'judul' => 'required',
            'isi' => 'required',
            'tags' => 'required',
            'status' => 'required|in_list[0,1]',
            'users_id' => 'required|integer'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/berita/', $newName);

            // Jika berhasil pindah, simpan ke database
            $categoryModel = new FrontendModel();
            $categoryModel->save([
                'kategori' => $this->request->getPost('kategori'),
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'tags' => $this->request->getPost('tags'),
                'tgl_publikasi' => date('Y-m-d H:i:s'), // Tanggal saat ini
                'gambar' => $newName,
                'status' => $this->request->getPost('status'),
                'slug' => url_title($this->request->getPost('judul'), '-', true),
                'users_id' => $this->request->getPost('users_id')
            ]);

            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => 'File upload failed.']);
        }
    }

    public function update_berita()
    {
        $model = new FrontendModel(); // Pastikan menggunakan namespace yang benar

        $id = $this->request->getPost('id');
        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $tags = $this->request->getPost('tags');
        // $kategori = $this->request->getPost('kategori');
        $status = $this->request->getPost('status');
        $users_id = $this->request->getPost('users_id');
        $kategori = 'berita';

        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'isi' => 'required',
            'tags' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . '/public/uploads/berita/', $newName);

            // Update with new image
            $data = [
                'judul' => $judul,
                'isi' => $isi,
                'tags' => $tags,
                'kategori' => $kategori,
                'status' => $status,
                'users_id' => $users_id,
                'gambar' => $newName,
            ];
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => ['Gambar tidak valid']]);
        }

        // Panggil metode update pada model yang sudah dibuat
        $model->update($id, $data);

        return $this->response->setJSON(['success' => true]);
    }


    public function update_berita_without_image()
    {
        $id = $this->request->getPost('id');
        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $tags = $this->request->getPost('tags');
        $kategori = $this->request->getPost('kategori');
        $status = $this->request->getPost('status');
        $users_id = $this->request->getPost('users_id');

        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'isi' => 'required',
            'tags' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['success' => false, 'errors' => $validation->getErrors()]);
        }

        $data = [
            'judul' => $judul,
            'isi' => $isi,
            'tags' => $tags,
            'kategori' => $kategori,
            'status' => $status,
            'users_id' => $users_id,
        ];

        $this->frontendModel->update($id, $data);
        return $this->response->setJSON(['success' => true]);
    }

    public function hapus_berita()
    {
        $id = $this->request->getPost('id');
        $model = new FrontendModel();

        if ($model->delete($id)) {
            return $this->respond(['status' => 'success'], 200);
        } else {
            return $this->respond(['status' => 'error'], 500);
        }
    }

    public function pengumuman()
    {
        return $this->loadView('admin/pengumuman');
    }

    public function pelatihan()
    {
        return $this->loadView('admin/pelatihan');
    }

    public function userslog()
    {
        return $this->loadView('admin/userslog');
    }

    public function users()
    {
        return $this->loadView('admin/users');
    }

    public function settings()
    {
        return $this->loadView('admin/settings');
    }

    public function backup()
    {
        return $this->loadView('admin/backup');
    }

    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI

        return view($viewName, $data);
    }
}
