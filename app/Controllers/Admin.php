<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FrontendModel;
use App\Models\UsersModel;
use App\Models\PencakerModel;
use App\Models\ActivityModel;

use App\Models\PendidikanModel;
use App\Models\PengalamanKerjaModel;
use App\Models\DokumenPencakerModel;
use App\Models\JenjangpendidikanModel;
use App\Models\DokumenModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use TCPDF;
use TCPDF_STATIC;
use App\Libraries\Pdf;


// use CodeIgniter\Controller;

class Admin extends BaseController
{

    public function index()
    {
        $pencakerModel = new PencakerModel();
        $pendidikanData = $pencakerModel->countByPendidikan();
        $usiaData = $pencakerModel->countByUsia();

        // Data untuk chart line
        $currentYear = date('Y');
        $pencakerData = $pencakerModel->getPencakerByGenderAndMonth($currentYear);

        // Proses data untuk dikirim ke view
        $months = [];
        $lakiData = [];
        $perempuanData = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = $this->bulan($i);
            $lakiData[$i] = 0;
            $perempuanData[$i] = 0;
        }

        foreach ($pencakerData as $data) {
            if ($data->jenkel == 'Laki-laki') {
                $lakiData[$data->bulan] = $data->jumlah;
            } else if ($data->jenkel == 'Perempuan') {
                $perempuanData[$data->bulan] = $data->jumlah;
            }
        }

        $data = [
            'title' => 'Dashboard',
            'registrasi_count' => $pencakerModel->countByStatus('Registrasi'),
            'verifikasi_count' => $pencakerModel->countByStatus('Verifikasi'),
            'validasi_count' => $pencakerModel->countByStatus('Validasi'),
            'aktif_count' => $pencakerModel->countByStatus('Aktif'),
            'bekerja_count' => $pencakerModel->countByStatus('Bekerja'),
            'wajib_lapor_count' => $pencakerModel->countByStatus('Wajib Lapor'),
            'pendidikan_data' => $pencakerModel->countByPendidikan(),
            'usia_data' => $pencakerModel->countByUsia(),

            // highchart
            'pendidikan_data' => json_encode($pendidikanData),
            'usia_data' => json_encode($usiaData),

            'currentYear' => $currentYear,
            'months' => json_encode(array_values($months)),
            'laki_data' => json_encode(array_values($lakiData)),
            'perempuan_data' => json_encode(array_values($perempuanData))
        ];

        return $this->loadView('admin/dashboard', $data);
    }

    protected function bulan($bulan)
    {
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        return $namaBulan[$bulan] ?? '';
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

        // Ambil nilai filter dari request
        $filter = $this->request->getPost('filter');

        // Ambil semua data user
        $users = $usersModel->findAll();

        // Sesuaikan query pencaker berdasarkan filter
        if ($filter) {
            $pencaker = $pencakerModel->where('keterangan_status', $filter)->findAll();
        } else {
            $pencaker = $pencakerModel->findAll();
        }

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
            $gambar = '<img src="' . $defaultImagePath . '" alt="' . $pc['namalengkap'] . '" title="' . $pc['namalengkap'] . '" width="40">';

            // Jika data user ditemukan
            if (!empty($userData)) {
                if (!empty($userData['img_type'])) {
                    // Jika ada gambar di database
                    $imagePath = base_url('path/to/image/' . $userData['img_type']);
                    if (file_exists(FCPATH . 'path/to/image/' . $userData['img_type'])) {
                        // Jika gambar ada di direktori
                        $gambar = '<img src="' . $imagePath . '" alt="' . $pc['namalengkap'] . '" title="' . $pc['namalengkap'] . '" width="40">';
                    } else {
                        // Jika gambar tidak ada di direktori
                        $gambar = '<img src="' . $defaultImagePath . '" aalt="' . $pc['namalengkap'] . '" title="' . $pc['namalengkap'] . '" width="40">';
                    }
                }
            }

            $data[] = [
                "verval" => '<button class="btn btn-secondary btn-sm btn-verval"
                                title="Verifikasi/Validasi Pencaker"
                                 data-id="' . $pc['id'] . '" 
                                 data-namalengkap="' . $pc['namalengkap'] . '" 
                                 data-nopendaftaran="' . $pc['nopendaftaran'] . '" 
                                 data-toggle="modal" 
                                 data-target="#VerVal">
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
                               <a href="' . base_url('admin/detail_pencaker/' . $pc['id']) . '" target="_blank" class="btn btn-info btn-sm" title="Detail Pencaker">
                                   <i class="bi bi-search px-2"></i>
                               </a>
                               <a href="' . base_url('admin/kartu_ak1/' . $pc['id']) . '" target="_blank" class="btn btn-success btn-sm" title="Kartu AK/1">
                                   <i class="bi bi-person-vcard-fill px-2"></i>
                               </a>
                               <button class="btn btn-danger btn-sm btn-delete" data-i="' . $pc['id'] . '" title="Babat Pencaker">
                                   <i class="bi bi-trash px-2"></i>
                               </button>
                           </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function detail_pencaker($id)
    {
        $pencakerModel = new PencakerModel();
        $pencaker = $pencakerModel->find($id);

        // if (!$pencaker) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Pencari kerja dengan ID ' . $id . ' tidak ditemukan.');
        // }

        $pendidikanModel = new PendidikanModel();
        $pendidikan = $pendidikanModel->where('pencaker_id', $id)->findAll();

        $pengalamanModel = new PengalamanKerjaModel();
        $pengalaman = $pengalamanModel->where('pencaker_id', $id)->findAll();

        $dokumenModel = new DokumenPencakerModel();
        $dokumen = $dokumenModel->where('pencaker_id', $id)->findAll();

        $jenjangPendidikan = new JenjangpendidikanModel();
        $jenjang = $jenjangPendidikan->where('id', $id)->findAll();

        $dokumenJenisModel = new DokumenModel();
        $dokumenJenis = $dokumenJenisModel->findAll();

        foreach ($dokumen as &$doc) {
            foreach ($dokumenJenis as $jenis) {
                if ($doc['dokumen_id'] == $jenis['id']) {
                    $doc['jenis_dokumen'] = $jenis['jenis_dokumen'];
                    break;
                }
            }
        }

        $data = [
            'title' => 'Review Data dan Dokumen Pencari Kerja',
            'pencaker' => $pencaker,
            'pendidikan' => $pendidikan,
            'pengalaman' => $pengalaman,
            'dokumen' => $dokumen,
            'jenjang' => $jenjang
        ];

        return view('admin/review_pencaker', $data);
    }

    public function kartu_ak1($id)
    {
        $pencakerModel = new PencakerModel();
        $pencaker = $pencakerModel->find($id);

        // if (!$pencaker) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Pencari kerja dengan ID ' . $id . ' tidak ditemukan.');
        // }

        $pendidikanModel = new PendidikanModel();
        $pendidikan = $pendidikanModel->where('pencaker_id', $id)->findAll();

        $pengalamanModel = new PengalamanKerjaModel();
        $pengalaman = $pengalamanModel->where('pencaker_id', $id)->findAll();

        $dokumenModel = new DokumenPencakerModel();
        $dokumen = $dokumenModel->where('pencaker_id', $id)->findAll();

        $jenjangPendidikan = new JenjangpendidikanModel();
        $jenjang = $jenjangPendidikan->where('id', $id)->findAll();

        $dokumenJenisModel = new DokumenModel();
        $dokumenJenis = $dokumenJenisModel->findAll();

        foreach ($dokumen as &$doc) {
            foreach ($dokumenJenis as $jenis) {
                if ($doc['dokumen_id'] == $jenis['id']) {
                    $doc['jenis_dokumen'] = $jenis['jenis_dokumen'];
                    break;
                }
            }
        }

        $data = [
            'title' => 'Kartu AK/1',
            'pencaker' => $pencaker,
            'pendidikan' => $pendidikan,
            'pengalaman' => $pengalaman,
            'dokumen' => $dokumen,
            'jenjang' => $jenjang
        ];

        return view('admin/kartu_ak1', $data);
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


    public function activitylogs()
    {
        $data['title'] = 'Aktivitas Pengguna';
        return $this->loadView('admin/activitylogs', $data);
    }

    function getUserIP()
    {
        $ipAddress = '';

        // Check for shared internet/ISP IP
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        }
        // Check for IPs passing through proxies
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        // Check for IP address from remote address
        else {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }

        // If IP address is "::1", convert to "127.0.0.1"
        if ($ipAddress == '::1') {
            $ipAddress = '127.0.0.1';
        }

        return $ipAddress;
    }

    public function activitylogsajax()
    {
        $activityModel = new ActivityModel();

        $ip_address = $this->request->getPost('ip_address');
        $user = $this->request->getPost('user');

        // Mengubah query untuk mengambil data activity_logs beserta nama user
        $activity = $activityModel->select('activity_logs.*, users.name as user_name')
            ->join('users', 'activity_logs.id = users.id', 'left');

        if ($ip_address) {
            $activity->like('activity_logs.ip_address', $ip_address);
        }

        if ($user) {
            $activity->where('activity_logs.id', $user);
        }

        $activity = $activity->findAll();

        $data = [];
        foreach ($activity as $item) {
            $data[] = [
                "id" => $item['id'],
                "ip_address" => $item['ip_address'],
                "title" => $item['title'],
                "created_at" => $item['created_at'],
                // Menggunakan $item['user_name'] untuk menampilkan nama user
                "aksi" => '<div class="btn-group" role="group" aria-label="Aksi">
                      <button class="btn btn-info btn-sm btn-detail-log" 
                             data-id="' . $item['id'] . '" 
                             data-title="' . $item['title'] . '" 
                             data-user="' . $item['user_name'] . '" 
                             data-created_at="' . $item['created_at'] . '" 
                             data-toggle="modal" 
                             data-target="#detailLogModal">
                             <i class="bi bi-check-circle-fill px-2"></i>
                         </button>
                      <a class="btn btn-info btn-sm btn-detail-user" data-id="' . $item['id'] . '">
                          <i class="bi bi-person-fill px-2"></i>
                      </a>
                   </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function getUsers()
    {
        $userModel = new UsersModel();
        $users = $userModel->findAll();

        $data = [];
        foreach ($users as $user) {
            $data[] = [
                "id" => $user['id'],
                "text" => $user['name']
            ];
        }

        echo json_encode($data);
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
        // $totalFilteredRecords = $usersModel->countAll();

        $data = [];
        $no = 1;

        // Mengisi data untuk DataTables
        foreach ($users as $user) {
            $defaultImagePath = base_url('uploads/user/no-user.jpg');

            // Tentukan path gambar berdasarkan kondisi
            if (!empty($user['img_type'])) {
                // Jika ada gambar di database
                $imagePath = base_url('uploads/user/' . $user['img_type']);
                if (!file_exists(FCPATH . 'uploads/user/' . $user['img_type'])) {
                    // Jika gambar tidak ada di direktori
                    $imagePath = $defaultImagePath;
                }
            } else {
                // Jika tidak ada gambar di database
                $imagePath = $defaultImagePath;
            }

            // Format gambar untuk ditampilkan dalam tabel atau modal
            $gambar = '<img src="' . $imagePath . '" alt="User Image" width="40">';

            // Format data lainnya sesuai kebutuhan
            $data[] = [
                "no" => $no++,
                // "img_type" => $gambar,
                // "name" => $user['name'],
                "email" => $user['email'],
                "username" => $user['username'],
                // "role" => $user['role'],
                "updated_at" => $user['updated_at'], // Asumsi 'updated_at' adalah waktu login terakhir
                "status" => '<input type="checkbox" class="js-switch" data-id="' . $user['id'] . '" ' . ($user['status'] ? 'checked' : '') . '>',
                "aksi" => '
                <div class="btn-group" role="group" aria-label="Actions">
                    <button class="btn btn-info btn-sm btn-detail-user" 
                        data-id="' . $user['id'] . '"  
                        data-email="' . htmlspecialchars($user['email']) . '" 
                        data-username="' . $user['username'] . '" 
                        data-updated_at="' . $user['updated_at'] . '" 
                        data-toggle="modal" 
                        data-target="#detailUserModal"
                        data-load-logs="true">
                        <i class="bi bi-eye px-2"></i>
                    </button>
                    <button class="btn btn-warning btn-sm btn-edit"
                        data-edit_id="' . $user['id'] . '"
                        data-toggle="modal"
                        data-target="#ubahUserBaruModal">
                        <i class="bi bi-pencil-square px-2"></i>
                    </button>
                    <button class="btn btn-danger btn-sm btn-delete" data-id="' . $user['id'] . '">
                        <i class="bi bi-trash px-2"></i>
                    </button>
            </div>'
            ];
        }

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

    public function exportPDF()
    {
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetTitle('DATA PENCARI KERJA');
        $pdf->SetHeaderMargin(20);
        $pdf->SetTopMargin(10);
        $pdf->setFooterMargin(15);
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->SetMargins(5, 10, 5, true);

        // Add a page
        $pdf->AddPage('L', 'A4');

        // Load PencakerModel
        $pencakerModel = new PencakerModel();
        $pencari_kerja = $pencakerModel->findAll(); // Ambil semua data pencari kerja

        // Set some content to display
        $html = '<style>
                    table {
                        font-size: 7px;
                        margin-left: auto;
                        margin-right: auto;
                    }
                    tr.center {
                        text-align: center;
                        background-color: #C0C0C0;
                        font-weight: bold;
                    }
                    div.heading {
                        text-align: center;
                        font-weight: bold;
                        font-size: 10px;
                    }
                    div.small {
                        font-size: 7px;
                        padding-bottom: 5px;
                    }
                </style>
                <div class="heading">DATA PENCARI KERJA KABUPATEN MANOKWARI</div>
                <div class="small"></div><br>
                <table width="100%" border="1" cellpadding="5">
                    <tr class="center">
                        <th width="22">No.</th>
                        <th width="80">Nama Lengkap</th>
                        <th width="19">JK</th>
                        <th width="82">Nomor Pendaftaran</th>
                        <th width="80">NIK</th>
                        <th width="40">Agama</th>
                        <th width="70">Alamat</th>
                        <th width="100">Tempat,<br> Tgl. Lahir</th>
                        <th width="40">Status<br> Menikah</th>
                        <th width="30">Kode Pos</th>
                        <th width="22">TB</th>
                        <th width="22">BB</th>
                        <th width="25">LJ</th>
                        <th width="60">Tujuan<br>Perusahaan</th>
                        <th width="60">Keterampilan<br>Bahasa</th>
                        <th width="60">Bahasa<br> Lainnya</th>
                    </tr>';

        $no = 1;
        foreach ($pencari_kerja as $pk) {
            $html .= '<tr>
                        <td align="center">' . $no . '</td>
                        <td align="center">' . $pk['namalengkap'] . '</td>
                        <td align="center">' . $pk['jenkel'] . '</td>
                        <td align="center">' . $pk['nopendaftaran'] . '</td>
                        <td align="center">' . $pk['nik'] . '</td>
                        <td align="center">' . $pk['agama'] . '</td>
                        <td align="center">' . $pk['alamat'] . '</td>
                        <td align="center">' . $pk['tempatlahir'] . ', ' . date('d F Y', strtotime($pk['tgllahir'])) . '</td>
                        <td align="center">' . $pk['statusnikah'] . '</td>
                        <td align="center">' . $pk['kodepos'] . '</td>
                        <td align="center">' . $pk['tinggibadan']  . '</td>
                        <td align="center">' . $pk['beratbadan'] . '</td>
                        <td align="center">' . $pk['lokasi_jabatan'] . '</td>
                        <td align="center">' . $pk['tujuan_perusahaan'] . '</td>
                        <td align="center">' . $pk['keterampilan_bahasa'] . '</td>
                        <td align="center">' . $pk['bahasa_lainnya'] . '</td>
                    </tr>';
            $no++;
        }

        $html .= '</table>';

        // Output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF document
        $pdf->Output('DATA PENCARI KERJA KABUPATEN MANOKWARI.pdf', 'I');
    }

    public function exportExcel()
    {
        $pencakerModel = new PencakerModel();
        $dataPencaker = $pencakerModel->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set margin kertas
        $sheet->getPageMargins()->setTop(1.5);
        $sheet->getPageMargins()->setRight(1.5);
        $sheet->getPageMargins()->setBottom(1.5);
        $sheet->getPageMargins()->setLeft(1.5);

        // Set orientasi kertas dan ukuran
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);

        // Tambahkan logo
        $logoPath = FCPATH . 'frontend/assets/img/logodisnakertransmkw.png';
        if (file_exists($logoPath)) {
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Logo');
            $drawing->setDescription('Logo');
            $drawing->setPath($logoPath);
            $drawing->setHeight(50);
            $drawing->setCoordinates('A1');
            $drawing->setWorksheet($sheet);
        }

        // Set title
        $sheet->setCellValue('A2', 'DATA PENCARI KERJA KABUPATEN MANOKWARI');
        $sheet->mergeCells('A2:P2');
        $sheet->getStyle('A2')->getFont()->setBold(true);
        $sheet->getStyle('A2')->getFont()->setSize(16);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Tambahkan header kolom
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama Lengkap');
        $sheet->setCellValue('C4', 'JK');
        $sheet->setCellValue('D4', 'Nomor Pendaftaran');
        $sheet->setCellValue('E4', 'NIK');
        $sheet->setCellValue('F4', 'Agama');
        $sheet->setCellValue('G4', 'Alamat');
        $sheet->setCellValue('H4', 'Tempat, Tgl. Lahir');
        $sheet->setCellValue('I4', 'Status Menikah');
        $sheet->setCellValue('J4', 'Kode Pos');
        $sheet->setCellValue('K4', 'TB');
        $sheet->setCellValue('L4', 'BB');
        $sheet->setCellValue('M4', 'LJ');
        $sheet->setCellValue('N4', 'Tujuan Perusahaan');
        $sheet->setCellValue('O4', 'Keterampilan');
        $sheet->setCellValue('P4', 'Bahasa Lainnya');

        // Format header kolom
        $headerStyle = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'ECF0F6']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['argb' => '000000']]],
        ];
        $sheet->getStyle('A4:P4')->applyFromArray($headerStyle);

        // Atur tinggi baris untuk header
        $sheet->getRowDimension(4)->setRowHeight(22);

        // Atur tinggi baris untuk data
        $row = 5;
        foreach ($dataPencaker as $pencaker) {
            $sheet->getRowDimension($row)->setRowHeight(20);
            $row++;
        }

        // Isi data
        $row = 5;
        $no = 1;
        foreach ($dataPencaker as $pencaker) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, ucwords(strtolower($pencaker['namalengkap'])));
            $sheet->setCellValue('C' . $row, $pencaker['jenkel']);
            $sheet->setCellValueExplicit('D' . $row, $pencaker['nopendaftaran'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('E' . $row, $pencaker['nik'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('F' . $row, $pencaker['agama']);
            $sheet->setCellValue('G' . $row, $pencaker['alamat']);
            $sheet->setCellValue('H' . $row, $pencaker['tempatlahir'] . ', ' . $pencaker['tgllahir']);
            $sheet->setCellValue('I' . $row, $pencaker['statusnikah']);
            $sheet->setCellValue('J' . $row, $pencaker['kodepos']);
            $sheet->setCellValue('K' . $row, $pencaker['tinggibadan']);
            $sheet->setCellValue('L' . $row, $pencaker['beratbadan']);
            $sheet->setCellValue('M' . $row, $pencaker['lokasi_jabatan']);
            $sheet->setCellValue('N' . $row, $pencaker['tujuan_perusahaan']);
            $sheet->setCellValue('O' . $row, $pencaker['keterampilan_bahasa']);
            $sheet->setCellValue('P' . $row, $pencaker['bahasa_lainnya']);

            // Atur alignment untuk data
            $sheet->getStyle('A' . $row . ':P' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A' . $row . ':P' . $row)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

            // Wrap text di setiap sel
            foreach (range('A', 'P') as $col) {
                $sheet->getStyle($col . $row)->getAlignment()->setWrapText(true);
            }

            $row++;
        }

        // Atur lebar kolom
        $sheet->getColumnDimension('A')->setWidth(3); // No
        $sheet->getColumnDimension('B')->setWidth(25); // Nama Lengkap
        $sheet->getColumnDimension('C')->setWidth(3); // JK
        $sheet->getColumnDimension('D')->setWidth(20); // Nomor Pendaftaran
        $sheet->getColumnDimension('E')->setWidth(17); // NIK
        $sheet->getColumnDimension('F')->setWidth(7); // Agama
        $sheet->getColumnDimension('G')->setWidth(30); // Alamat
        $sheet->getColumnDimension('H')->setWidth(25); // Tempat, Tgl. Lahir
        $sheet->getColumnDimension('I')->setWidth(15); // Status Menikah
        $sheet->getColumnDimension('J')->setWidth(9); // Kode Pos
        $sheet->getColumnDimension('K')->setWidth(4); // TB
        $sheet->getColumnDimension('L')->setWidth(4); // BB
        $sheet->getColumnDimension('M')->setWidth(4); // LJ
        $sheet->getColumnDimension('N')->setWidth(30); // Tujuan Perusahaan
        $sheet->getColumnDimension('O')->setWidth(25); // Keterampilan
        $sheet->getColumnDimension('P')->setWidth(30); // Bahasa Lainnya

        // Set nama file dan atur header untuk mengunduh file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'DATA_PENCARI_KERJA_KABUPATEN_MANOKWARI.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
        $writer->save('php://output');
        exit;
    }
}
