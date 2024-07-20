<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FrontendModel;
use App\Models\UsersModel;
use App\Models\PencakerModel;
use App\Models\ActivityModel;
use App\Models\DatabaseModel;

use App\Models\PendidikanModel;
use App\Models\PengalamanKerjaModel;
use App\Models\DokumenPencakerModel;
use App\Models\JenjangpendidikanModel;
use App\Models\DokumenModel;
use App\Models\BahasaModel;
use App\Models\JabatanModel;
use App\Models\PerusahaanModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use TCPDF;
use TCPDF_STATIC;
use App\Libraries\Pdf;

use Myth\Auth\Models\UserModel;
use Myth\Auth\Entities\User;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

// use CodeIgniter\Controller;

class Admin extends BaseController
{

    public function index()
    {
        $pencakerModel = new PencakerModel();
        $pendidikanData = $pencakerModel->countByPendidikan();
        $usiaData = $pencakerModel->countByUsia();

        $currentYear = date('Y');
        $pencakerData = $pencakerModel->getPencakerByGenderAndMonth($currentYear);

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

            'pendidikan_data' => json_encode($pendidikanData),
            'usia_data' => json_encode($usiaData),

            'currentYear' => $currentYear,
            'months' => json_encode(array_values($months)),
            'laki_data' => json_encode(array_values($lakiData)),
            'perempuan_data' => json_encode(array_values($perempuanData))
        ];

        return $this->loadView('admin/dashboard', $data);
    }

    public function redirectDashboard()
    {
        return redirect()->to('admin_v2/dashboard');
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
        $pencakerModel = new PencakerModel();

        // Ambil nilai filter dari request
        $filter = $this->request->getPost('filter');

        // Ambil data pencaker dengan join ke tabel users
        $pencaker = $pencakerModel->getPencakerWithUser($filter);

        $data = [];

        foreach ($pencaker as $pc) {
            $defaultImagePath = base_url('uploads/user/no-user.jpg');
            $gambar = '<img src="' . $defaultImagePath . '" alt="' . $pc['namalengkap'] . '" title="' . $pc['namalengkap'] . '" width="40">';

            if (!empty($pc['img_type'])) {
                $imagePath = base_url('path/to/image/' . $pc['img_type']);
                if (file_exists(FCPATH . 'path/to/image/' . $pc['img_type'])) {
                    $gambar = '<img src="' . $imagePath . '" alt="' . $pc['namalengkap'] . '" title="' . $pc['namalengkap'] . '" width="40">';
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
                             <i class="bi bi-check-circle-fill"></i>
                         </button>',
                "img" => $gambar,
                "namalengkap" => $pc['namalengkap'],
                "nopendaftaran" => $pc['nopendaftaran'],
                "nik" => $pc['nik'],
                "nohp" => $pc['nohp'], // Ambil phone dari userData jika ada
                "email" =>  $pc['email'], // Ambil email dari userData jika ada
                "keterangan_status" => $pc['keterangan_status'],
                "aksi" => '<div class="btn-group" role="group" aria-label="Actions">
                           <a href="' . base_url('admin_v2/detail_pencaker/' . $pc['id']) . '" target="_blank" class="btn btn-info btn-sm" title="Detail Pencaker">
                               <i class="bi bi-search"></i>
                           </a>
                           <a href="' . base_url('admin_v2/kartu_ak1/' . $pc['id']) . '" target="_blank" class="btn btn-success btn-sm" title="Kartu AK/1">
                               <i class="bi bi-person-vcard-fill"></i>
                           </a>
                           <button class="btn btn-danger btn-sm btn-delete" data-i="' . $pc['id'] . '" title="Babat Pencaker">
                               <i class="bi bi-trash"></i>
                           </button>
                       </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }


    public function detail_pencaker($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, pencaker.namalengkap, created_at, nopendaftaran, pencaker.nik, tempatlahir, tgllahir, tinggibadan, beratbadan, jenkel, agama, alamat, kodepos, statusnikah, pencaker.id, keterampilan_bahasa, bahasa_lainnya, pencaker.nohp');
        $builder->join('pencaker', 'pencaker.user_id = users.id');
        // $builder->join('pendidikan_pencaker', 'pendidikan_pencaker.pencaker_id = pencaker.id');
        // $builder->join('jenjang_pendidikan', 'jenjang_pendidikan.id = jenjang_pendidikan_id');
        $query = $builder->get();

        $pencaker = $query->getRowArray();
        // $pencakerModel = new PencakerModel();
        // $pencaker = $pencakerModel->find($id);


        $builder = $db->table('pencaker');
        $builder->select('pencaker.id, nama_sekolah, tahunmasuk, tahunlulus, ipk, keterampilan, pendidikan_pencaker.id');
        $builder->join('pendidikan_pencaker', 'pendidikan_pencaker.pencaker_id = pencaker.id');
        // $builder->join('jenjang_pendidikan', 'jenjang_pendidikan.id = pendidikan_pencaker.jenjang_pendidikan_id');

        $q_pendidikan = $builder->get();
        $pendidikan = $q_pendidikan->getResultArray();

        // $pendidikanModel = new PendidikanModel();
        // $pendidikan = $pendidikanModel->where('pencaker_id', $id)->findAll();

        $pengalamanModel = new PengalamanKerjaModel();
        $pengalaman = $pengalamanModel->where('pencaker_id', $id)->findAll();

        $dokumenModel = new DokumenPencakerModel();
        $dokumen = $dokumenModel->where('pencaker_id', $id)->findAll();

        $jenjangPendidikan = new JenjangpendidikanModel();
        $jenjangPd = $jenjangPendidikan->where('id', $id)->findAll();

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
            'jenjang' => $jenjangPd
        ];

        // return view('admin/review_pencaker', $data);
        return $this->loadView('admin/review_pencaker', $data);
    }

    public function kartu_ak1($id_pencaker)
    {



        $pencakerModel = new PencakerModel();
        $pencaker = $pencakerModel->find($id_pencaker);
        $dokumen = $pencakerModel->getdokumenpencaker($id_pencaker); // Mengambil satu hasil query sebagai array

        $pendidikanModel = new PendidikanModel();
        $pendidikan = $pendidikanModel->where('pencaker_id', $id_pencaker)->findAll();

        $pengalamanModel = new PengalamanKerjaModel();
        $pengalaman = $pengalamanModel->where('pencaker_id', $id_pencaker)->findAll();

        $jenjangPendidikan = new JenjangpendidikanModel();
        $jenjang = $jenjangPendidikan->where('id', $id_pencaker)->findAll();

        $data = [
            'title' => 'Kartu AK/1',
            'pencaker' => $pencaker,
            'pendidikan' => $pendidikan,
            'pengalaman' => $pengalaman,
            'dokumen' => $dokumen,
            'jenjang' => $jenjang
        ];

        return $this->loadView('admin/kartu_ak1', $data);
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
                            <i class="bi bi-eye"></i>
                        </a>
                        <button class="btn btn-warning btn-sm btn-edit" data-edit_id="' . $item['id'] . '"  data-edit_judul="' . htmlspecialchars($item['judul']) . '" data-edit_isi="' . htmlspecialchars($item['isi']) . '" data-edit_tags="' . $item['tags'] . '" data-edit_gambar="' . $item['gambar'] . '" data-toggle="modal"  data-toggle="modal" data-target="#ubahBeritaBaruModal"> <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $item['id'] . '">
                            <i class="bi bi-trash"></i>
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
                            <i class="bi bi-eye"></i>
                        </a>
                        <button class="btn btn-warning btn-sm btn-edit" data-edit_id="' . $item['id'] . '"  data-edit_judul="' . htmlspecialchars($item['judul']) . '" data-edit_isi="' . htmlspecialchars($item['isi']) . '" data-edit_tags="' . $item['tags'] . '" data-edit_gambar="' . $item['gambar'] . '" data-toggle="modal"  data-toggle="modal" data-target="#ubahPengumumanModal"> <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $item['id'] . '">
                            <i class="bi bi-trash"></i>
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
                            <i class="bi bi-eye"></i>
                        </a>
                        <button class="btn btn-warning btn-sm btn-edit" data-edit_id="' . $item['id'] . '"  data-edit_judul="' . htmlspecialchars($item['judul']) . '" data-edit_isi="' . htmlspecialchars($item['isi']) . '" data-edit_tags="' . $item['tags'] . '" data-edit_gambar="' . $item['gambar'] . '" data-toggle="modal"  data-toggle="modal" data-target="#ubahPelatihanModal"> <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-danger btn-sm btn-delete" data-id="' . $item['id'] . '">
                            <i class="bi bi-trash"></i>
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

    public function activitylogsajax()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, name, namalengkap, auth_groups.name as group_name, user_agent, ip_address, auth_activation_attempts.created_at');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $builder->join('auth_activation_attempts', 'auth_activation_attempts.id = users.id');
        $query = $builder->get();

        $logs = $query->getResult();

        $data = [];
        foreach ($logs as $item) {
            $data[] = [
                "id" => $item->userid,
                "ip_address" => $item->ip_address,
                "email" => $item->email,
                "username" => $item->username,
                "user_agent" => $item->user_agent,
                "name" => $item->name,
                "date" => $item->created_at,
                // Menggunakan $item->group_name untuk menampilkan nama grup user
                "aksi" => '<div class="btn-group" role="group" aria-label="Aksi">
                  <button class="btn btn-info btn-sm btn-detail-log" 
                         data-id="' . $item->userid . '" 
                         data-ip_address="' . $item->ip_address . '" 
                         data-email="' . $item->email . '" 
                         data-date="' . $item->created_at . '" 
                         data-toggle="modal" 
                         data-target="#detailLogModal">
                         <i class="bi bi-check-circle-fill"></i>
                     </button>
                  <a class="btn btn-info btn-sm btn-detail-user" data-id="' . $item->userid . '">
                      <i class="bi bi-person-fill"></i>
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
                "text" => $user['username']
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
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, nohp, nik, status, email, name, namalengkap, auth_groups.name as group_name, users.updated_at');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        $query = $builder->get();

        $users = $query->getResult();

        $data = [];
        $no = 1;  // Penomoran untuk tabel
        foreach ($users as $user) {
            $defaultImagePath = base_url('uploads/user/no-user.jpg');

            // Tentukan path gambar berdasarkan kondisi
            $imagePath = $defaultImagePath;
            if (!empty($user->img_type)) {
                $imagePath = base_url('uploads/user/' . $user->img_type);
                if (!file_exists(FCPATH . 'uploads/user/' . $user->img_type)) {
                    $imagePath = $defaultImagePath;
                }
            }

            // Format gambar untuk ditampilkan dalam tabel atau modal
            $gambar = '<img src="' . $imagePath . '" alt="User Image" width="40">';

            // Format data lainnya sesuai kebutuhan
            $data[] = [
                "no" => $no++,
                "namalengkap" => $user->namalengkap,
                "email" => $user->email,
                "username" => $user->username,
                "updated_at" => $user->updated_at,
                "name" => $user->name,
                "status" => '<input type="checkbox" class="js-switch" data-id="' . $user->userid . '" ' . ($user->status ? 'checked' : '') . '>',
                "aksi" => '
                <div class="btn-group" role="group" aria-label="Actions">
                    <button class="btn btn-info btn-sm btn-detail-user" 
                        data-id="' . $user->userid . '"  
                        data-email="' . htmlspecialchars($user->email) . '" 
                        data-namalengkap="' . $user->namalengkap . '" 
                        data-username="' . $user->username . '" 
                        data-nik="' . $user->nik . '" 
                        data-nohp="' . $user->nohp . '" 
                        data-name="' . $user->name . '" 
                        data-updated_at="' . $user->updated_at . '" 
                        data-toggle="modal" 
                        data-target="#detailUserModal"
                        data-load-logs="true">
                        <i class="bi bi-eye"></i>
                    </button>
                    <button class="btn btn-warning btn-sm btn-edit"
                        data-edit_id="' . $user->userid . '"
                        data-toggle="modal"
                        data-target="#ubahUserBaruModal">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger btn-sm btn-delete" data-id="' . $user->userid . '">
                        <i class="bi bi-trash"></i>
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

    public function download_db()
    {
        $model = new DatabaseModel();
        $databaseContent = $model->exportDatabase();

        $dbName = $model->db->getDatabase();
        $filename = $dbName . '.sql';

        return $this->response->download($filename, $databaseContent);
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

    // Generate nomopendaftaran
    public function nomorpendaftaran()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT RIGHT(nopendaftaran, 6) AS nopendaftaran FROM pencaker ORDER BY nopendaftaran DESC LIMIT 1");

        if ($query->getNumRows() <> 0) {
            $data = $query->getRow();
            $nourut = intval($data->nopendaftaran) + 1;
        } else {
            $nourut = 1;  // cek jika kode belum terdapat pada tabel
        }

        $tgl = date('Y');
        $batas = str_pad($nourut, 6, "0", STR_PAD_LEFT);
        $nopendaftaran = "9202" . $tgl . $batas;  // format kode
        return $nopendaftaran;
    }


    public function profil_pencaker()
    {
        $bahasaModel = new BahasaModel();
        $bahasa = $bahasaModel->findAll();

        $jenjangPendidikan = new JenjangpendidikanModel();
        $jenjang = $jenjangPendidikan->findAll();

        $usersModel = new UsersModel();
        $userId = user()->id;

        // Ambil data pengguna berdasarkan user ID
        $user = $usersModel->find($userId);
        $pencakerModel = new PencakerModel();

        $id_pencaker = $pencakerModel->get_pencaker_id_by_user_id($user['id']);

        // Dapatkan nomor pendaftaran yang di-generate oleh sistem
        $nopendaftaran = $this->nomorpendaftaran();

        $data = [
            'title' => 'Profil Pencari Kerja',
            'jenjang' => $jenjang,
            'user' => $user,
            'nopendaftaran' => $nopendaftaran,
            'bahasa' => $bahasa,
            'id_pencaker' => $id_pencaker
        ];

        return $this->loadView('admin/profil_pencaker', $data);
    }

    public function save_data_tujuan()
    {
        $pencakerModel = new PencakerModel();

        $userId = $this->request->getPost('id_pencaker');

        $data = [
            'user_id' => $userId,
            'tujuan' => $this->request->getPost('tujuan'),
        ];

        // Check if user already exists in the pencaker table
        $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

        if ($existingPencaker) {
            // Update the existing record
            $pencakerModel->update($existingPencaker['id'], $data);
        } else {
            // Insert a new record
            $pencakerModel->insert($data);
        }

        return $this->response->setStatusCode(200)->setBody('Data berhasil disimpan');
    }

    public function get_data_tujuan($id)
    {
        $pencakerModel = new PencakerModel();
        $data = $pencakerModel->where('user_id', $id)->first();
        return $this->response->setJSON($data);
    }


    // public function save_data_keterangan_umum()
    // {
    //     $pencakerModel = new PencakerModel();

    //     $userId = $this->request->getPost('id_pencaker');

    //     $data = [
    //         'user_id' => $userId,
    //         'nopendaftaran' => $this->request->getPost('nopendaftaran'),
    //         'nik' => $this->request->getPost('nik'),
    //         'namalengkap' => $this->request->getPost('namalengkap'),
    //         'nohp' => $this->request->getPost('nohp'),
    //         'email' => $this->request->getPost('email'),
    //         'jenkel' => $this->request->getPost('jenkel'),
    //         'tempatlahir' => $this->request->getPost('tempatlahir'),
    //         'tgllahir' => $this->request->getPost('tgllahir'),
    //         'statusnikah' => $this->request->getPost('statusnikah'),
    //         'agama' => $this->request->getPost('agama'),
    //         'tinggibadan' => $this->request->getPost('tinggibadan'),
    //         'beratbadan' => $this->request->getPost('beratbadan'),
    //         'alamat' => $this->request->getPost('alamat'),
    //         'kodepos' => $this->request->getPost('kodepos'),
    //         'keterangan_status' => 'Registrasi',
    //     ];

    //     // Check if user already exists in the pencaker table
    //     $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

    //     if ($existingPencaker) {
    //         // Update the existing record
    //         $pencakerModel->update($existingPencaker['id'], $data);
    //     } else {
    //         // Insert a new record
    //         $pencakerModel->insert($data);
    //     }

    //     return $this->response->setStatusCode(200)->setBody('Data berhasil disimpan');
    // }


    public function save_data_keterangan_umum()
    {
        $pencakerModel = new PencakerModel();

        $userId = $this->request->getPost('id_pencaker');
        $nopendaftaran = $this->request->getPost('nopendaftaran');
        $qrcode = $this->generate_qr_code($nopendaftaran);

        $data = [
            'user_id' => $userId,
            'nopendaftaran' => $this->request->getPost('nopendaftaran'),
            'nik' => $this->request->getPost('nik'),
            'namalengkap' => $this->request->getPost('namalengkap'),
            'nohp' => $this->request->getPost('nohp'),
            'email' => $this->request->getPost('email'),
            'jenkel' => $this->request->getPost('jenkel'),
            'tempatlahir' => $this->request->getPost('tempatlahir'),
            'tgllahir' => $this->request->getPost('tgllahir'),
            'statusnikah' => $this->request->getPost('statusnikah'),
            'agama' => $this->request->getPost('agama'),
            'tinggibadan' => $this->request->getPost('tinggibadan'),
            'beratbadan' => $this->request->getPost('beratbadan'),
            'alamat' => $this->request->getPost('alamat'),
            'kodepos' => $this->request->getPost('kodepos'),
            'keterangan_status' => 'Registrasi',
            'qr_code' => $qrcode,
        ];

        // Check if user already exists in the pencaker table
        $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

        if ($existingPencaker) {
            // Update the existing record
            $pencakerModel->update($existingPencaker['id'], $data);
        } else {
            // Insert a new record
            $pencakerModel->insert($data);
        }

        // Generate QR code
        $this->generate_qr_code($data['nopendaftaran']);

        return $this->response->setStatusCode(200)->setBody('Data berhasil disimpan');
    }

    public function generate_qr_code($nopendaftaran)
    {
        $qrCode = new QrCode(site_url("admin/validasi_ak1/" . sha1($nopendaftaran)));
        $qrCode->setSize(300);

        $writer = new PngWriter();
        $qrImage = $writer->write($qrCode);

        // Directory where QR codes will be saved
        $directory = FCPATH . 'uploads/pencaker/qrcode/';

        // Ensure the directory exists
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $qrName = $nopendaftaran . '.png';
        $qrImage->saveToFile($directory . $qrName);

        return $qrName;
    }


    public function validasi_ak1($code)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pencaker p');
        $builder->select('*, DATE(tu.tglwaktu) AS tglaktifpencaker');
        $builder->join('pencaker_dokumen pd', 'pd.pencaker_id = p.id');
        $builder->join('dokumen d', 'd.id = pd.dokumen_id');
        $builder->join('users u', 'u.id = p.user_id');
        $builder->join('timeline_user tu', 'tu.user_id = u.id');
        $builder->where('d.id', '1');
        $builder->where('tu.timeline_id', '6');
        $builder->where('SHA1(p.nopendaftaran)', $code);
        $getPencaker = $builder->get();

        $data['v_msg'] = new \stdClass();

        if ($getPencaker->getNumRows() > 0) {
            $data['v_msg']->valid = "Kartu Anda Valid dan Terdaftar di Sistem Dinas Tenaga Kerja dan Transmigrasi Kabupaten Manokwari";
            $data['v_msg']->code = TRUE;
            $data['v_msg']->pencaker = $getPencaker->getRow();
        } else {
            $data['v_msg']->valid = "Maaf, Kartu Anda Tidak Terdaftar di Sistem Disnakertrans Manokwari!";
            $data['v_msg']->code = FALSE;
        }

        $data['page'] = new \stdClass();
        $data['page']->menu = 'dashboard';
        $data['page']->title = 'Pelatihan';

        echo view('frontend/validasi_ak1', $data);
    }


    public function get_data_keterangan_umum($id)
    {
        $pencakerModel = new PencakerModel();
        $data = $pencakerModel->where('user_id', $id)->first();
        return $this->response->setJSON($data);
    }

    public function save_data_pendidikan()
    {
        $pendidikanModel = new PendidikanModel();

        $pencaker_id = $this->request->getPost('pencaker_id');
        $jenjang_pendidikan_id = $this->request->getPost('jenjang');

        $data = [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'tahunmasuk' => $this->request->getPost('tahunmasuk'),
            'tahunlulus' => $this->request->getPost('tahunlulus'),
            'ipk' => $this->request->getPost('ipk'),
            'keterampilan' => $this->request->getPost('keterampilan'),
            'pencaker_id' => $pencaker_id,
            'jenjang_pendidikan_id' => $jenjang_pendidikan_id
        ];

        // Cek apakah data dengan pencaker_id dan jenjang_pendidikan_id sudah ada
        $existingData = $pendidikanModel->where('pencaker_id', $pencaker_id)
            ->where('jenjang_pendidikan_id', $jenjang_pendidikan_id)
            ->first();

        if ($existingData) {
            // Jika data sudah ada, lakukan update
            $pendidikanModel->update($existingData['id'], $data);
            $response = [
                'status' => 'success',
                'message' => 'Data pendidikan berhasil diperbarui.'
            ];
        } else {
            // Jika data belum ada, lakukan insert
            if ($pendidikanModel->save($data)) {
                $response = [
                    'status' => 'success',
                    'message' => 'Data pendidikan berhasil disimpan.'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data pendidikan.'
                ];
            }
        }

        return $this->response->setJSON($response);
    }

    public function fetch_data_pendidikan()
    {
        $pendidikanModel = new PendidikanModel();
        $request = service('request');

        // Ambil pencaker_id dari request
        $pencaker_id = $this->request->getPost('pencaker_id');

        // Ambil data pendidikan dengan join ke tabel jenjang_pendidikan
        $pendidikan = $pendidikanModel->select('pendidikan_pencaker.*, jenjang_pendidikan.jenjang')
            ->join('jenjang_pendidikan', 'pendidikan_pencaker.jenjang_pendidikan_id = jenjang_pendidikan.id', 'left')
            ->where('pendidikan_pencaker.pencaker_id', $pencaker_id)
            ->orderBy('jenjang_pendidikan.id', 'ASC')
            ->findAll();

        $data = [];
        $no = 1;
        foreach ($pendidikan as $pd) {
            $data[] = [
                'no' => $no++,
                'tahunmasuk' => $pd['tahunmasuk'],
                'tahunlulus' => $pd['tahunlulus'],
                'jenjang' => $pd['jenjang'],
                'nama_sekolah' => $pd['nama_sekolah'],
                'ipk' => $pd['ipk'],
                'keterampilan' => $pd['keterampilan'],
                'aksi' => '<div class="btn-group" role="group" aria-label="Actions">
                           <button class="btn btn-primary btn-sm editPendidikan" data-id="' . $pd['id'] . '" data-pencaker_id="' . $pd['pencaker_id'] . '" title="Edit Pendidikan">
                               <i class="bi bi-pencil-fill"></i>
                           </button>
                           <button class="btn btn-danger btn-sm deletePendidikan" data-id="' . $pd['id'] . '" title="Hapus Pendidikan">
                               <i class="bi bi-trash"></i>
                           </button>
                       </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function get_pendidikan_by_id()
    {
        $request = service('request');
        $id = $request->getPost('id'); // Ambil ID dari POST data

        $model = new PendidikanModel(); // Buat instance model PendidikanModel

        $pendidikan = $model->find($id); // Ambil data pendidikan berdasarkan ID

        if ($pendidikan) {
            // Jika data pendidikan ditemukan, kirim respons JSON
            return $this->response->setJSON($pendidikan)->setStatusCode(200);
        } else {
            // Jika data tidak ditemukan, kirim respons error
            return $this->response->setJSON(['message' => 'Data pendidikan tidak ditemukan'])->setStatusCode(404);
        }
    }

    public function update_data_pendidikan()
    {
        $request = service('request');

        // Ambil data dari POST request
        $data = [
            'id' => $request->getPost('id'),
            'nama_sekolah' => $request->getPost('nama_sekolah'),
            'tahunmasuk' => $request->getPost('tahunmasuk'),
            'tahunlulus' => $request->getPost('tahunlulus'),
            'ipk' => $request->getPost('ipk'),
            'keterampilan' => $request->getPost('keterampilan'),
            'jenjang' => $request->getPost('jenjang'),
            'pencaker_id' => user()->id,
        ];

        $model = new PendidikanModel(); // Buat instance model PendidikanModel

        // Lakukan update data pendidikan berdasarkan ID
        if ($model->update($data['id'], $data)) {
            // Jika berhasil update, kirim respons JSON sukses
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            // Jika gagal update, kirim respons JSON error
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }


    public function hapus_data_pendidikan()
    {
        $id = $this->request->getPost('id');
        $model = new PendidikanModel();

        // Hapus data pendidikan dari database berdasarkan id
        if ($model->delete($id)) {
            // Berhasil menghapus, kembalikan respons JSON sukses
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            // Gagal menghapus, kembalikan respons JSON error
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }


    // Penglaman Kerja
    public function save_data_pengalaman_kerja()
    {
        $pengalamanKerjaModel = new PengalamanKerjaModel();

        $pencaker_id = $this->request->getPost('pencaker_id');

        $data = [
            'tahunmasuk' => $this->request->getPost('tahunmasukkerja'),
            'tahunkeluar' => $this->request->getPost('tahunkeluarkerja'),
            'instansi' => $this->request->getPost('instansi'),
            'jabatan' => $this->request->getPost('jabatan'),
            'pencaker_id' => $pencaker_id,
        ];

        // Jika data belum ada, lakukan insert
        if ($pengalamanKerjaModel->save($data)) {
            $response = [
                'status' => 'success',
                'message' => 'Data pengalaman kerja berhasil disimpan.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal menyimpan data pengalaman kerja.'
            ];
        }


        return $this->response->setJSON($response);
    }

    public function fetch_data_pengalaman_kerja()
    {
        $pengalamanKerjaModel = new PengalamanKerjaModel();

        // Ambil pencaker_id dari request
        $pencaker_id = $this->request->getPost('pencaker_id');

        // Ambil data pendidikan dengan join ke tabel jenjang_pendidikan
        $pekerjaan = $pengalamanKerjaModel->findAll();

        $pekerjaan = $pengalamanKerjaModel->select('pengalaman_kerja.*')
            ->where('pengalaman_kerja.pencaker_id', $pencaker_id)
            ->findAll();

        $data = [];
        $no = 1;
        foreach ($pekerjaan as $pk) {
            $data[] = [
                'no' => $no++,
                'tahunmasuk' => $pk['tahunmasuk'],
                'tahunkeluar' => $pk['tahunkeluar'],
                'instansi' => $pk['instansi'],
                'jabatan' => $pk['jabatan'],
                'aksi' => '<div class="btn-group" role="group" aria-label="Actions">
                           <button class="btn btn-primary btn-sm editPekerjaan" data-id="' . $pk['id'] . '" data-pencaker_id="' . $pk['pencaker_id'] . '" title="Edit Pekerjaan">
                               <i class="bi bi-pencil-fill"></i>
                           </button>
                           <button class="btn btn-danger btn-sm deletePekerjaan" data-id="' . $pk['id'] . '" title="Hapus Pekerjaan">
                               <i class="bi bi-trash"></i>
                           </button>
                       </div>'
            ];
        }

        echo json_encode(["data" => $data]);
    }

    public function get_pengalaman_kerja_by_id()
    {
        $request = service('request');
        $id = $request->getPost('id');

        $model = new PengalamanKerjaModel();

        $pekerjaan = $model->find($id);

        if ($pekerjaan) {
            // Jika data pekerjaan ditemukan, kirim respons JSON
            return $this->response->setJSON($pekerjaan)->setStatusCode(200);
        } else {
            // Jika data tidak ditemukan, kirim respons error
            return $this->response->setJSON(['message' => 'Data pekerjaan tidak ditemukan'])->setStatusCode(404);
        }
    }

    public function update_data_pengalaman_kerja()
    {
        $request = service('request');

        // Ambil data dari POST request
        $data = [
            'id' => $request->getPost('id'),
            'tahunmasuk' => $request->getPost('tahunmasukkerja'),
            'tahunkeluar' => $request->getPost('tahunkeluarkerja'),
            'instansi' => $request->getPost('instansi'),
            'jabatan' => $request->getPost('jabatan'),
            'pencaker_id' => user()->id,
        ];

        if (empty($data['id'])) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'ID is missing'])->setStatusCode(400);
        }

        $model = new PengalamanKerjaModel(); // Buat instance model PengalamanKerjaModel

        // Lakukan update data pendidikan berdasarkan ID
        if ($model->update($data['id'], $data)) {
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }

    public function hapus_data_pengalaman_kerja()
    {
        $id = $this->request->getPost('id');
        $model = new PengalamanKerjaModel();

        // Hapus data pendidikan dari database berdasarkan id
        if ($model->delete($id)) {
            // Berhasil menghapus, kembalikan respons JSON sukses
            return $this->response->setJSON(['status' => 'success'])->setStatusCode(200);
        } else {
            // Gagal menghapus, kembalikan respons JSON error
            return $this->response->setJSON(['status' => 'error'])->setStatusCode(500);
        }
    }

    //  Minat Jabatan
    public function save_data_minat_jabatan()
    {
        $jabatanModel = new JabatanModel();
        $pencakerModel = new PencakerModel(); // Tambahkan model PencakerModel

        $pencaker_id = $this->request->getPost('id_pencaker');

        $dataJabatan = [
            'pencaker_id' => $pencaker_id,
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'lokasi_jabatan' => $this->request->getPost('lokasi_jabatan'),
        ];

        $dataPencaker = [
            'lokasi_jabatan' => $this->request->getPost('lokasi_jabatan'),
        ];

        // Check if user already exists in the minat_jabatan table
        $existingJabatan = $jabatanModel->where('pencaker_id', $pencaker_id)->first();

        if ($existingJabatan) {
            // Update the existing record in minat_jabatan table
            $jabatanModel->update($existingJabatan['id'], $dataJabatan);
        } else {
            // Insert a new record into minat_jabatan table
            $jabatanModel->insert($dataJabatan);
        }

        // Update the lokasi_jabatan in pencaker table using user_id
        $existingPencaker = $pencakerModel->where('user_id', $pencaker_id)->first();
        if ($existingPencaker) {
            $pencakerModel->update($existingPencaker['id'], $dataPencaker);
        }

        return $this->response->setStatusCode(200)->setBody('Data berhasil disimpan');
    }


    public function get_data_minat_jabatan($id)
    {
        $jabatanModel = new JabatanModel();
        $data = $jabatanModel->where('pencaker_id', $id)->first();
        return $this->response->setJSON($data);
    }


    // Perushaan Tujuan

    // public function save_data_perusahaan_tujuan()
    // {
    //     $perusahaanModel = new PerusahaanModel();

    //     $id = $this->request->getPost('id');  // Ambil id perusahaan jika ada
    //     $pencaker_id = $this->request->getPost('pencaker_id');

    //     $data = [
    //         'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
    //         'nohp_perusahaan' => $this->request->getPost('nohp_perusahaan'),
    //         'alamat_perusahaan' => $this->request->getPost('alamat_perusahaan'),
    //         'pencaker_id' => $pencaker_id,
    //     ];

    //     // Cek apakah data dengan pencaker_id tersebut sudah ada di database
    //     $existingData = $perusahaanModel->where('pencaker_id', $pencaker_id)->first();

    //     if ($existingData) {
    //         // Jika data sudah ada, lakukan update
    //         $perusahaanModel->update($existingData['id'], $data);
    //         $response = [
    //             'status' => 'success',
    //             'message' => 'Data perusahaan tujuan berhasil diperbarui.'
    //         ];
    //     } else {
    //         // Jika data belum ada, lakukan insert
    //         if ($perusahaanModel->insert($data)) {
    //             $response = [
    //                 'status' => 'success',
    //                 'message' => 'Data perusahaan tujuan berhasil disimpan.'
    //             ];
    //         } else {
    //             $response = [
    //                 'status' => 'error',
    //                 'message' => 'Gagal menyimpan data perusahaan tujuan.'
    //             ];
    //         }
    //     }

    //     return $this->response->setJSON($response);
    // }

    public function save_data_perusahaan_tujuan()
    {
        $perusahaanModel = new PerusahaanModel();
        $pencakerModel = new PencakerModel(); // Tambahkan model PencakerModel

        // $id = $this->request->getPost('id');  // Ambil id perusahaan jika ada
        $pencaker_id = $this->request->getPost('pencaker_id');
        // $user_id = $this->request->getPost('user_id'); // Dapatkan user_id dari form

        $dataPerusahaan = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'nohp_perusahaan' => $this->request->getPost('nohp_perusahaan'),
            'alamat_perusahaan' => $this->request->getPost('alamat_perusahaan'),
            'pencaker_id' => $pencaker_id,
        ];

        $dataPencaker = [
            'tujuan_perusahaan' => $this->request->getPost('nama_perusahaan'),
        ];

        // Cek apakah data dengan pencaker_id tersebut sudah ada di database
        $existingData = $perusahaanModel->where('pencaker_id', $pencaker_id)->first();

        if ($existingData) {
            // Jika data sudah ada, lakukan update
            $perusahaanModel->update($existingData['id'], $dataPerusahaan);
        } else {
            // Jika data belum ada, lakukan insert
            if ($perusahaanModel->insert($dataPerusahaan)) {
                // Tidak ada aksi khusus yang perlu dilakukan di sini
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data perusahaan tujuan.'
                ];
                return $this->response->setJSON($response);
            }
        }

        // Update the tujuan_perusahaan in pencaker table using user_id
        $existingPencaker = $pencakerModel->where('user_id', $pencaker_id)->first();
        if ($existingPencaker) {
            $pencakerModel->update($existingPencaker['id'], $dataPencaker);
        }

        $response = [
            'status' => 'success',
            'message' => 'Data perusahaan tujuan berhasil disimpan.'
        ];
        return $this->response->setJSON($response);
    }

    public function get_perusahaan_tujuan_by_id($id)
    {
        $perusahaanModel = new PerusahaanModel();
        $data = $perusahaanModel->where('pencaker_id', $id)->first();
        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan.'], 404);
        }
    }


    // Data Tambahan
    public function save_catatan_pengantar()
    {
        $pencakerModel = new PencakerModel();

        $userId = $this->request->getPost('id_pencaker');
        $catatanPengantar = $this->request->getPost('catatan_pengantar');

        // Validasi input (opsional)
        if (empty($userId) || empty($catatanPengantar)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID Pencaker dan Catatan Pengantar harus diisi.',
            ]);
        }

        // Data untuk diupdate
        $data = [
            'catatan_pengantar' => $catatanPengantar,
        ];

        // Cari data pencaker berdasarkan user_id
        $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

        if ($existingPencaker) {
            // Jika data sudah ada, lakukan update
            $pencakerModel->update($existingPencaker['id'], $data);
        } else {
            // Jika data belum ada, lakukan insert
            $data['user_id'] = $userId;
            $pencakerModel->insert($data);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Catatan pengantar berhasil disimpan.',
        ]);
    }

    public function get_catatan_pengantar_by_id($id)
    {
        $pencakerModel = new PencakerModel();
        $data = $pencakerModel->where('user_id', $id)->first();
        return $this->response->setJSON($data);
    }

    public function save_bahasa()
    {
        $pencakerModel = new PencakerModel();

        $userId = $this->request->getPost('id_pencaker');
        $keterampilanBahasa = $this->request->getPost('keterampilan_bahasa');
        $bahasaLainnya = $this->request->getPost('bahasa_lainnya');

        // Validasi input (opsional)
        if (empty($userId) || (empty($keterampilanBahasa) && empty($bahasaLainnya))) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'ID Pencaker dan keterampilan bahasa atau bahasa lainnya harus diisi.',
            ]);
        }

        // Data untuk diupdate
        $data = [
            'keterampilan_bahasa' => $keterampilanBahasa,
            'bahasa_lainnya' => $bahasaLainnya
        ];

        // Cari data pencaker berdasarkan user_id
        $existingPencaker = $pencakerModel->where('user_id', $userId)->first();

        if ($existingPencaker) {
            // Jika data sudah ada, lakukan update
            $pencakerModel->update($existingPencaker['id'], $data);
        } else {
            // Jika data belum ada, lakukan insert
            $data['user_id'] = $userId;
            $pencakerModel->insert($data);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Data keterampilan bahasa berhasil disimpan.',
        ]);
    }


    public function get_bahasa_pencaker_by_id($id)
    {
        $pencakerModel = new PencakerModel();
        $data = $pencakerModel->where('user_id', $id)->first();
        if ($data) {
            return $this->response->setJSON($data);
        } else {
            return $this->response->setJSON(['error' => 'Data tidak ditemukan.'], 404);
        }
    }


    // Upload Dokumen
    public function dokumen_pencaker()
    {
        // Paket paneggil data user dari tabel Users agar bisa diparsing dalam halaman view formdata_pencaker
        $usersModel = new UsersModel();
        $userId = user()->id;
        $user = $usersModel->find($userId);

        $dokumenModel = new DokumenModel();
        $jenis_dokumen = $dokumenModel->findAll();
        $data = [
            'title' => 'Review Data dan Dokumen Pencari Kerja',
            'jenis_dok' => $jenis_dokumen,
            'user' => $user,
        ];

        return $this->loadView('admin/formdata_pencaker', $data);
    }

    public function dokajax()
    {
        $dokumenModel = new DokumenModel();
        $dokumenPencakerModel = new DokumenPencakerModel();

        $dokumen = $dokumenModel->findAll();

        $data = [];
        $no = 1;

        foreach ($dokumen as $dok) {

            $pencakerDokumen = $dokumenPencakerModel->where('dokumen_id', $dok['id'])
                ->where('pencaker_id', user()->id)
                ->first();

            if ($pencakerDokumen) {
                $data[] = [
                    "no" => $no++,
                    "jenis" => $dok['jenis_dokumen'],
                    "nama" => $pencakerDokumen['namadokumen'],
                    "tgl" => $pencakerDokumen['tgl_upload'],
                    "aksi" => '<div class="btn-group" role="group" aria-label="Actions">
                           <a href="' . base_url('uploads/dokumen_pencaker/' . $pencakerDokumen['namadokumen']) . '" target="_blank" class="btn btn-info btn-sm" title="Detail Dokumen">
                               <i class="bi bi-search"></i>
                           </a>
                           <button class="btn btn-danger btn-sm deleteDokumen" data-id="' . $pencakerDokumen['id'] . '" title="Hapus Dokumen">
                               <i class="bi bi-trash"></i>
                           </button>
                       </div>'
                ];
            } else {

                $data[] = [
                    "no" => $no++,
                    "jenis" => $dok['jenis_dokumen'],
                    "nama" => '-',
                    "tgl" => '-',
                    "aksi" => '<div class="btn-group" role="group" aria-label="Actions">
                           <a data-id="' . $dok['id'] . '"  data-jenis="' . $dok['jenis_dokumen'] . '"  data-toggle="modal" data-target="#uploadDokumenModal" class="btn btn-success btn-sm uplodDokumenBTN" title="Upload Dokumen">
                               <i class="bi bi-upload"></i>
                           </a>
                       </div>'
                ];
            }
        }

        echo json_encode(["data" => $data]);
    }

    public function upload_dokumen()
    {
        $validationRules = [
            'dokumen_id' => 'required|numeric',
            'jenis_dokumen' => 'required',
            'file' => 'uploaded[file]|max_size[file,256]'
        ];

        if (!$this->validate($validationRules)) {
            $response['success'] = false;
            $response['errors'] = $this->validator->getErrors();
            return $this->response->setJSON($response);
        }

        $dokumenId = $this->request->getPost('dokumen_id');
        $jenisDokumen = $this->request->getPost('jenis_dokumen');
        $file = $this->request->getFile('file');

        $nik = user()->nik;

        $fileExtension = $file->getClientExtension();
        $newFileName = $nik . '_' . str_replace(' ', '-', strtoupper($jenisDokumen)) . '.' . $fileExtension;

        $uploadPath = FCPATH . 'uploads/dokumen_pencaker/' . $nik . '/';

        // Cek apakah folder dengan nama NIK sudah ada, jika tidak, buat folder baru
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $model = new DokumenPencakerModel();
        $existingDokumen = $model->where(['pencaker_id' => user()->id, 'dokumen_id' => $dokumenId])->first();

        if ($existingDokumen) {
            // Hapus file lama jika ada
            $oldFilePath = $uploadPath . $existingDokumen['namadokumen'];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            // Update data dengan file baru
            $data = [
                'namadokumen' => $newFileName,
                'tgl_upload' => date('Y-m-d H:i:s')
            ];
            $model->update($existingDokumen['id'], $data);
        } else {
            // Insert data baru
            $data = [
                'namadokumen' => $newFileName,
                'tgl_upload' => date('Y-m-d H:i:s'),
                'pencaker_id' => user()->id,
                'dokumen_id' => $dokumenId,
            ];
            $model->insert($data);
        }

        if (!$file->move($uploadPath, $newFileName)) {
            $response['success'] = false;
            $response['errors'] = ['Failed to upload file.'];
            return $this->response->setJSON($response);
        }

        $response['success'] = true;
        $response['message'] = 'File berhasil diunggah.';
        return $this->response->setJSON($response);
    }


    public function hapus_dokumen()
    {
        $id = $this->request->getPost('id');
        $model = new DokumenPencakerModel();

        $dokumen = $model->find($id);
        if (!$dokumen) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'dokumen tidak ditemukan'])->setStatusCode(404);
        }

        // Hapus gambar dari direktori jika ada
        $file_dokumen = $dokumen['namadokumen'];
        if (!empty($file_dokumen)) {
            $nik = user()->nik; // Pastikan Anda mendapatkan NIK dari user
            $path = FCPATH . 'uploads/dokumen_pencaker/' . $nik . '/' . $file_dokumen;
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


    public function pengaturan()
    {
        $userId = user()->id; // Mengambil user ID dari sesi

        $db = \Config\Database::connect();
        $builder = $db->table('pencaker_dokumen');
        $builder->select('pencaker_dokumen.namadokumen');
        $builder->where('pencaker_dokumen.pencaker_id', $userId);
        $builder->where('pencaker_dokumen.dokumen_id', 1, 'pencaker_id', $userId); // Kondisi untuk mengambil dokumen dengan ID 1
        $query = $builder->get();

        $dokumen = $query->getRow(); // Mengambil satu baris hasil query

        $data = [
            'title' => 'Pengaturan Profile',
            'dokumen' => $dokumen,
        ];

        return $this->loadView('admin/myprofile', $data);
    }


    // public function requestVerification()
    // {
    //     $pencakerModel = new PencakerModel();
    //     $userId = session()->get('user_id'); // Mengambil user_id dari session

    //     if ($userId) {
    //         $data = [
    //             'keterangan_status' => 'Validasi'
    //         ];
    //         $pencakerModel->update($userId, $data);
    //         return $this->response->setJSON(['status' => 'success', 'message' => 'Status updated successfully.']);
    //     }

    //     return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to update status.']);
    // }


    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $data['current_uri'] = $uri->getSegment(2); // Ambil segmen kedua dari URI

        return view($viewName, $data);
    }
}
