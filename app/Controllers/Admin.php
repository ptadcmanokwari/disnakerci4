<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FrontendModel;

class Admin extends BaseController
{

    public function index()
    {
        $data['title'] = 'Dashboard';
        return $this->loadView('admin/dashboard', $data);
    }

    public function pencaker()
    {
        $data['title'] = 'Manajemen Pencaker';
        return $this->loadView('admin/pencaker', $data);
    }

    public function berita()
    {
        $data['title'] = 'Manajemen Berita';
        return $this->loadView('admin/berita', $data);
    }

    // tampilkan data di tabel berita
    public function beritaajax()
    {
        $beritaModel = new FrontendModel();
        $berita = $beritaModel->getInformasiByKategori('berita', 10, 0);

        $data = [];
        $no = 1;
        foreach ($berita as $item) {
            $gambar = '<img src="' . base_url('uploads/berita/' . esc($item['gambar'])) . '" alt="' . esc($item['judul']) . '" width="100">';
            $gambar = htmlspecialchars_decode($gambar);

            $data[] = [
                "no" => $no++,
                "judul" => $item['judul'],
                "isi" => $item['isi'],
                "gambar" => $gambar,
                "status" => '<input type="checkbox" class="js-switch" data-id="' . $item['id'] . '" ' . ($item['status'] ? 'checked' : '') . '>',
                "aksi" =>
                '<div class="btn-group" role="group" aria-label="Aksi">
                        <a href="' . base_url('admin/detail_berita/' . $item['id']) . '" class="btn btn-info btn-sm">
                            <i class="bi bi-eye px-2"></i>
                        </a>
                        <button class="btn btn-warning btn-sm btn-edit" data-edit_id="' . $item['id'] . '"  data-edit_judul="' . htmlspecialchars($item['judul']) . '" data-edit_isi="' . htmlspecialchars($item['isi']) . '" data-edit_tags="' . $item['tags'] . '" data-edit_gambar="' . $item['gambar'] . '" data-toggle="modal"  data-toggle="modal" data-target="#ubahBeritaBaruModal"> <i class="bi bi-pencil-square px-2"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $item['id'] . '">
                            <i class="bi bi-trash px-2"></i>
                        </button>
                    </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }

    // toggle switchery
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

    // Simpan berita unggahan baru
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
            $file->move(FCPATH . 'uploads/berita/', $newName);

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

    // Sunting berita
    public function update_berita()
    {
        $model = new FrontendModel();

        $id = $this->request->getPost('id');
        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $tags = $this->request->getPost('tags');
        $kategori = 'berita';
        $status = 1;
        $users_id = 1;

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

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Ambil data gambar lama
            $current_data = $model->find($id);
            $current_gambar = $current_data['gambar'];

            // Hapus gambar lama jika ada
            if (!empty($current_gambar)) {
                $path = FCPATH . 'uploads/berita/' . $current_gambar;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Proses upload gambar baru
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/berita/', $newName);
            $data['gambar'] = $newName;
        }

        $model->update($id, $data);

        return $this->response->setJSON(['success' => true]);
    }


    public function hapus_berita()
    {
        $id = $this->request->getPost('id');
        $model = new FrontendModel();

        $berita = $model->find($id);
        if (!$berita) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Berita tidak ditemukan'])->setStatusCode(404);
        }

        // Hapus gambar dari direktori jika ada
        $gambar = $berita['gambar'];
        if (!empty($gambar)) {
            $path = FCPATH . 'uploads/berita/' . $gambar;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        if ($model->delete($id)) {
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }


    public function pengumuman()
    {
        $data['title'] = 'Manajemen Pengumuman';
        return $this->loadView('admin/pengumuman', $data);
    }

    public function pengumumanajax()
    {
        $pengumumanModel = new FrontendModel();
        $pengumuman = $pengumumanModel->getInformasiByKategori('pengumuman', 10, 0);

        $data = [];
        $no = 1;
        foreach ($pengumuman as $item) {
            $gambar = '<img src="' . base_url('uploads/pengumuman/' . esc($item['gambar'])) . '" alt="' . esc($item['judul']) . '" width="100">';
            $gambar = htmlspecialchars_decode($gambar);

            $data[] = [
                "no" => $no++,
                "judul" => $item['judul'],
                "isi" => $item['isi'],
                "gambar" => $gambar,
                "status" => '<input type="checkbox" class="js-switch" data-id="' . $item['id'] . '" ' . ($item['status'] ? 'checked' : '') . '>',
                "aksi" =>
                '<div class="btn-group" role="group" aria-label="Aksi">
                        <a href="' . base_url('admin/detail_pengumuman/' . $item['id']) . '" class="btn btn-info btn-sm">
                            <i class="bi bi-eye px-2"></i>
                        </a>
                        <button class="btn btn-warning btn-sm btn-edit" data-edit_id="' . $item['id'] . '"  data-edit_judul="' . htmlspecialchars($item['judul']) . '" data-edit_isi="' . htmlspecialchars($item['isi']) . '" data-edit_tags="' . $item['tags'] . '" data-edit_gambar="' . $item['gambar'] . '" data-toggle="modal"  data-toggle="modal" data-target="#ubahPengumumanModal"> <i class="bi bi-pencil-square px-2"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $item['id'] . '">
                            <i class="bi bi-trash px-2"></i>
                        </button>
                    </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function update_status_pengumuman()
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

    public function save_pengumuman()
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
            $file->move(FCPATH . 'uploads/pengumuman/', $newName);

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


    public function update_pengumuman()
    {
        $model = new FrontendModel();

        $id = $this->request->getPost('id');
        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $tags = $this->request->getPost('tags');
        $kategori = 'pengumuman';
        $status = 1;
        $users_id = 1;

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

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Ambil data gambar lama
            $current_data = $model->find($id);
            $current_gambar = $current_data['gambar'];

            // Hapus gambar lama jika ada
            if (!empty($current_gambar)) {
                $path = FCPATH . 'uploads/pengumuman/' . $current_gambar;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Proses upload gambar baru
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/pengumuman/', $newName);
            $data['gambar'] = $newName;
        }

        $model->update($id, $data);

        return $this->response->setJSON(['success' => true]);
    }



    public function hapus_pengumuman()
    {
        $id = $this->request->getPost('id');
        $model = new FrontendModel();

        // Ambil nama file gambar yang akan dihapus
        $pengumuman = $model->find($id);
        $gambar = $pengumuman['gambar'];

        // Hapus gambar dari direktori
        if (!empty($gambar) && file_exists(FCPATH . 'uploads/pengumuman/' . $gambar)) {
            unlink(FCPATH . 'uploads/pengumuman/' . $gambar);
        }

        // Hapus pengumuman dari database
        if ($model->delete($id)) {
            // Berhasil menghapus, kembalikan respons JSON sukses
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            // Gagal menghapus, kembalikan respons JSON error
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }


    public function pelatihan()
    {
        $data['title'] = 'Manajemen Pelatihan';
        return $this->loadView('admin/pelatihan', $data);
    }

    public function pelatihanajax()
    {
        $pelatihanModel = new FrontendModel();
        $pelatihan = $pelatihanModel->getInformasiByKategori('pelatihan', 10, 0);

        $data = [];
        $no = 1;
        foreach ($pelatihan as $item) {
            $gambar = '<img src="' . base_url('uploads/pelatihan/' . esc($item['gambar'])) . '" alt="' . esc($item['judul']) . '" width="100">';
            $gambar = htmlspecialchars_decode($gambar);

            $data[] = [
                "no" => $no++,
                "judul" => $item['judul'],
                "isi" => $item['isi'],
                "gambar" => $gambar,
                "status" => '<input type="checkbox" class="js-switch" data-id="' . $item['id'] . '" ' . ($item['status'] ? 'checked' : '') . '>',
                "aksi" =>
                '<div class="btn-group" role="group" aria-label="Aksi">
                        <a href="' . base_url('admin/detail_pelatihan/' . $item['id']) . '" class="btn btn-info btn-sm">
                            <i class="bi bi-eye px-2"></i>
                        </a>
                        <button class="btn btn-warning btn-sm btn-edit" data-edit_id="' . $item['id'] . '"  data-edit_judul="' . htmlspecialchars($item['judul']) . '" data-edit_isi="' . htmlspecialchars($item['isi']) . '" data-edit_tags="' . $item['tags'] . '" data-edit_gambar="' . $item['gambar'] . '" data-toggle="modal"  data-toggle="modal" data-target="#ubahPelatihanModal"> <i class="bi bi-pencil-square px-2"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $item['id'] . '">
                            <i class="bi bi-trash px-2"></i>
                        </button>
                    </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function update_status_pelatihan()
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

    public function save_pelatihan()
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
            $file->move(FCPATH . 'uploads/pelatihan/', $newName);

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


    public function update_pelatihan()
    {
        $model = new FrontendModel();

        $id = $this->request->getPost('id');
        $judul = $this->request->getPost('judul');
        $isi = $this->request->getPost('isi');
        $tags = $this->request->getPost('tags');
        $kategori = 'pelatihan';
        $status = 1;
        $users_id = 1;

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

        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Ambil data gambar lama
            $current_data = $model->find($id);
            $current_gambar = $current_data['gambar'];

            // Hapus gambar lama jika ada
            if (!empty($current_gambar)) {
                $path = FCPATH . 'uploads/pelatihan/' . $current_gambar;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Proses upload gambar baru
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/pelatihan/', $newName);
            $data['gambar'] = $newName;
        }

        $model->update($id, $data);

        return $this->response->setJSON(['success' => true]);
    }

    public function hapus_pelatihan()
    {
        $id = $this->request->getPost('id');
        $model = new FrontendModel();

        // Ambil nama file gambar yang akan dihapus
        $pelatihan = $model->find($id);
        $gambar = $pelatihan['gambar'];

        // Hapus gambar dari direktori
        if (!empty($gambar) && file_exists(FCPATH . 'uploads/pelatihan/' . $gambar)) {
            unlink(FCPATH . 'uploads/pelatihan/' . $gambar);
        }

        // Hapus pelatihan dari database
        if ($model->delete($id)) {
            // Berhasil menghapus, kembalikan respons JSON sukses
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            // Gagal menghapus, kembalikan respons JSON error
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }


    public function userslog()
    {
        $data['title'] = 'Aktivitas Pengguna';
        return $this->loadView('admin/userslog', $data);
    }

    public function users()
    {
        $data['title'] = 'Manajemen User';
        return $this->loadView('admin/users', $data);
    }

    public function settings()
    {
        $data['title'] = 'Pengaturan';
        return $this->loadView('admin/settings', $data);
    }

    public function backup()
    {
        $data['title'] = 'Backup Database';
        return $this->loadView('admin/backup', $data);
    }

    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI

        return view($viewName, $data);
    }
}
