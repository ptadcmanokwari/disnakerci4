<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FrontendModel;
use App\Models\UsersModel;
use App\Models\PencakerModel;

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

    public function pencakerajax()
    {
        $usersModel = new UsersModel();
        $pencakerModel = new PencakerModel();

        $users = $usersModel->findAll(); // Ambil semua data user
        $pencaker = $pencakerModel->findAll(); // Ambil semua data pencaker
        $totalFilteredRecords = $usersModel->countAll(); // Hitung total data user

        $data = [];

        foreach ($pencaker as $pc) {
            $userData = null;

            // Cari data user yang sesuai berdasarkan users_id dari pencaker
            foreach ($users as $user) {
                if ($user['id'] == $pc['users_id']) {
                    $userData = $user;
                    break;
                }
            }

            $defaultImagePath = base_url('uploads/user/no-user.jpg');
            $gambar = '<img src="' . $defaultImagePath . '" alt="User Image" width="40">';

            // Jika data user ditemukan
            if (!empty($userData)) {
                if (!empty($userData['img_type'])) {
                    // Jika ada gambar di database
                    $imagePath = base_url('path/to/image/' . $userData['img_type']);
                    if (file_exists(FCPATH . 'path/to/image/' . $userData['img_type'])) {
                        // Jika gambar ada di direktori
                        $gambar = '<img src="' . $imagePath . '" alt="User Image" width="40">';
                    } else {
                        // Jika gambar tidak ada di direktori
                        $gambar = '<img src="' . $defaultImagePath . '" alt="User Image" width="40">';
                    }
                }
            }

            $data[] = [
                "verval" => '<button class="btn btn-secondary btn-sm btn-edit" data-edit_id="' . $pc['id'] . '" data-toggle="modal" data-target="#ubahPencakerModal">
                            <i class="bi bi-check-circle-fill px-2"></i>
                        </button>',
                "img" => $gambar,
                "namalengkap" => $pc['namalengkap'],
                "nopendaftaran" => $pc['nopendaftaran'],
                "nik" => $pc['nik'],
                "phone" => isset($userData['phone']) ? $userData['phone'] : '', // Ambil phone dari userData jika ada
                "email" => isset($userData['email']) ? $userData['email'] : '', // Ambil email dari userData jika ada
                "keterangan_status" => $pc['keterangan_status'],
                "aksi" => '<div class="btn-group" role="group" aria-label="Actions">
                        <a href="' . base_url('admin/detail_pencaker/' . $pc['id']) . '" class="btn btn-info btn-sm">
                            <i class="bi bi-search px-2"></i>
                        </a>
                        <button class="btn btn-success btn-sm btn-edit" data-edit_id="' . $pc['id'] . '" data-toggle="modal" data-target="#ubahPencakerModal">
                            <i class="bi bi-person-vcard-fill px-2"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $pc['id'] . '">
                            <i class="bi bi-trash px-2"></i>
                        </button>
                    </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }


    public function update_status_pencaker()
    {
        $id = $this->request->getJSON()->id;
        $status = $this->request->getJSON()->status;

        $model = new PencakerModel();
        $update = $model->update($id, ['status' => $status]);

        if ($update) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function hapus_pencaker()
    {
        $pencakerID = $this->request->getPost('pencakerID'); // Pastikan nama parameter sesuai dengan data yang dikirimkan dari AJAX
        $model = new PencakerModel();

        // Lakukan penghapusan dengan klausa where
        $deleted = $model->delete($pencakerID);

        if ($deleted) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Pencaker berhasil dihapus'])->setStatusCode(200);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus pencaker'])->setStatusCode(500);
        }
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

    public function usersajax()
    {
        $usersModel = new UsersModel();

        // Mengambil data users dari model
        $users = $usersModel->findAll();
        $totalFilteredRecords = $usersModel->countAll();

        $data = [];
        $no = 1;

        // Mengisi data untuk DataTables
        foreach ($users as $user) {
            $defaultImagePath = base_url('uploads/user/no-user.jpg');

            if (!empty($user['img_type'])) {
                // Jika ada gambar di database
                $imagePath = base_url('path/to/image/' . $user['img_type']);
                if (file_exists(FCPATH . 'path/to/image/' . $user['img_type'])) {
                    // Jika gambar ada di direktori
                    $gambar = '<img src="' . $imagePath . '" alt="User Image" width="40">';
                } else {
                    // Jika gambar tidak ada di direktori
                    $gambar = '<img src="' . $defaultImagePath . '" alt="User Image" width="40">';
                }
            } else {
                // Jika tidak ada gambar di database
                $gambar = '<img src="' . $defaultImagePath . '" alt="User Image" width="40">';
            }

            $data[] = [
                "no" => $no++,
                "img_type" => $gambar,
                "name" => $user['name'],
                "email" => $user['email'],
                "role" => $user['role'],
                "last_login" => $user['updated_at'], // Di sini saya mengasumsikan 'updated_at' adalah waktu login terakhir
                "status" => '<input type="checkbox" class="js-switch" data-id="' . $user['id'] . '" ' . ($user['status'] ? 'checked' : '') . '>',
                "aksi" =>
                '<div class="btn-group" role="group" aria-label="Actions">
                        <a href="' . base_url('admin/detail_user/' . $user['id']) . '" class="btn btn-info btn-sm">
                            <i class="bi bi-eye px-2"></i>
                        </a>
                        <button class="btn btn-warning btn-sm btn-edit" data-edit_id="' . $user['id'] . '" data-edit_name="' . htmlspecialchars($user['name']) . '" data-edit_email="' . htmlspecialchars($user['email']) . '" data-edit_role="' . $user['role'] . '" data-edit_gambar="' . $user['img_type'] . '" data-toggle="modal" data-target="#ubahUserBaruModal">
                            <i class="bi bi-pencil-square px-2"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $user['id'] . '">
                            <i class="bi bi-trash px-2"></i>
                        </button>
                    </div>'
            ];
        }

        // Mengembalikan data dalam format JSON untuk DataTables
        echo json_encode(["data" => $data]);
    }


    public function update_status_user()
    {
        $id = $this->request->getJSON()->id;
        $status = $this->request->getJSON()->status;

        $model = new UsersModel();
        $update = $model->update($id, ['status' => $status]);

        if ($update) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }

    public function hapus_user()
    {
        $userId = $this->request->getPost('user_id'); // Sesuaikan dengan nama yang dikirimkan dari AJAX
        $model = new UsersModel();

        $user = $model->find($userId);
        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan'])->setStatusCode(404);
        }

        // Hapus gambar profil dari direktori jika ada
        $imgType = isset($user['img_type']) ? $user['img_type'] : null;
        if (!empty($imgType)) {
            $path = FCPATH . 'uploads/user/' . $imgType;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Lakukan penghapusan dengan klausa where
        $deleted = $model->where('id', $userId)->delete();

        if ($deleted) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'User berhasil dihapus'])->setStatusCode(200);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus user'])->setStatusCode(500);
        }
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
