<?php

namespace App\Controllers;

use App\Models\FrontendModel;
use App\Models\PencakerModel;
use App\Models\PendidikanModel;
use App\Helpers\QrCodeHelper;

class Frontend extends BaseController
{
    public function index(): string
    {
        $pencakerModel = new PencakerModel();
        $pendidikanModel = new PendidikanModel();

        $q_umur = $pencakerModel->getUmurStatistik();

        $q_pendidikan_terakhir = $pendidikanModel->getPendidikanStatistik();

        $pencaker_count = $pencakerModel->countPencaker();

        // Prepare data for view
        $data['c_umur'] = $q_umur;
        $data['c_pendidikan_terakhir'] = $q_pendidikan_terakhir;
        $data['max_umur'] = $pencaker_count;

        $data['sliders'] = $this->getSliders();
        $data['galleries'] = $this->getHomeGalleries();
        $data['title'] = 'Beranda - Disnakertrans Manokwari';

        return $this->loadView('frontend/home', $data);
    }

    // Ambil data galeri dinamis dari folder uploads
    private function getHomeGalleries(): array
    {
        $path = WRITEPATH . '../public/uploads/tenagakerja/';
        $directories = array_filter(glob($path . '*'), 'is_dir');
        $galleries = [];

        foreach ($directories as $directory) {
            $category = basename($directory);
            $images = array_filter(glob($directory . '/*'), 'is_file');

            foreach ($images as $image) {
                $galleries[$category][] = [
                    'url' => base_url('uploads/tenagakerja/' . $category . '/' . basename($image)),
                    'name' => pathinfo($image, PATHINFO_FILENAME)
                ];
            }
        }

        return $galleries;
    }

    // Dinamiskan SLider
    private function getSliders(): array
    {
        $path = WRITEPATH . '../public/uploads/sliders/';
        $images = array_filter(glob($path . '*'), 'is_file');
        $sliders = [];

        foreach ($images as $image) {
            $sliders[] = [
                'url' => base_url('uploads/sliders/' . basename($image)),
                'name' => pathinfo($image, PATHINFO_FILENAME)
            ];
        }

        return $sliders;
    }


    public function profil(): string
    {
        $data['title'] = 'Profil - Disnakertrans Manokwari';

        return $this->loadView('frontend/profil', $data);
    }

    public function transmigrasi(): string
    {
        $data['galleries'] = $this->getTransmigrasiGalleries();
        $data['title'] = 'Urusan Transmigrasi - Disnakertrans Manokwari';
        return $this->loadView('frontend/transmigrasi', $data);
    }

    private function getTransmigrasiGalleries(): array
    {
        $path = WRITEPATH . '../public/uploads/transmigrasi/';
        $directories = array_filter(glob($path . '*'), 'is_dir');
        $galleries = [];

        foreach ($directories as $directory) {
            $category = basename($directory);
            $images = array_filter(glob($directory . '/*'), 'is_file');

            foreach ($images as $image) {
                $galleries[$category][] = [
                    'url' => base_url('uploads/transmigrasi/' . $category . '/' . basename($image)),
                    'name' => pathinfo($image, PATHINFO_FILENAME)
                ];
            }
        }

        return $galleries;
    }

    public function tenaga_kerja(): string
    {
        $data['galleries'] = $this->getTenagakerjaGalleries();
        $data['title'] = 'Urusan Tenaga Kerja - Disnakertrans Manokwari';
        return $this->loadView('frontend/tenaga_kerja', $data);
    }

    private function getTenagakerjaGalleries(): array
    {
        $path = WRITEPATH . '../public/uploads/tenagakerja/';
        $directories = array_filter(glob($path . '*'), 'is_dir');
        $galleries = [];

        foreach ($directories as $directory) {
            $category = basename($directory);
            $images = array_filter(glob($directory . '/*'), 'is_file');

            foreach ($images as $image) {
                $galleries[$category][] = [
                    'url' => base_url('uploads/tenagakerja/' . $category . '/' . basename($image)),
                    'name' => pathinfo($image, PATHINFO_FILENAME)
                ];
            }
        }

        return $galleries;
    }

    public function berita1(): string
    {
        $informasiModel = new FrontendModel();

        // Pagination configuration
        $perPage = 3;
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;

        // Ambil data informasi berita
        $kategori = 'berita'; // Kategori yang ingin ditampilkan
        $totalRows = $informasiModel->countInformasiByKategori($kategori);
        log_message('info', 'Total Rows: ' . $totalRows);

        // Pagination setup
        $data['informasi'] = $informasiModel->getInformasiByKategori($kategori, $perPage, ($currentPage - 1) * $perPage);
        log_message('info', 'Informasi Data: ' . print_r($data['informasi'], true));

        $data['kategori'] = $informasiModel->getKategoriCount();

        // Ambil berita terbaru berdasarkan kategori
        $data['recentPosts'] = $informasiModel->getRecentPostsByKategori($kategori);

        // Ambil daftar tags dari semua informasi
        $tagsArray = [];
        foreach ($data['informasi'] as $info) {
            $tagsArray = array_merge($tagsArray, explode(',', $info['tags']));
        }
        $data['uniqueTags'] = array_unique($tagsArray);

        $data['title'] = 'Berita - Disnakertrans Manokwari';

        // Set pager jika ada data
        if (!empty($data['informasi'])) {
            $data['pager'] = $informasiModel->pager;
        }

        return $this->loadView('frontend/beritama', $data);
    }


    public function berita(): string
    {
        $informasiModel = new FrontendModel();

        // Pagination configuration
        $perPage = 3;
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;

        // Ambil data informasi berita
        $kategori = 'Berita'; // Kategori yang ingin ditampilkan
        $totalRows = $informasiModel->countInformasiByKategori($kategori);

        // Pagination setup
        $data['informasi'] = $informasiModel->getInformasiByKategori($kategori, $perPage, ($currentPage - 1) * $perPage);
        $data['kategori'] = $informasiModel->getKategoriCount();

        // Ambil berita terbaru berdasarkan kategori
        $data['recentPosts'] = $informasiModel->getRecentPostsByKategori($kategori);

        // Ambil daftar tags dari semua informasi
        $tagsArray = [];
        foreach ($data['informasi'] as $info) {
            $tagsArray = array_merge($tagsArray, explode(',', $info['tags']));
        }
        $data['uniqueTags'] = array_unique($tagsArray);

        $data['title'] = 'Pengumuman- Disnakertrans Manokwari';

        // Set pager jika ada data
        if (!empty($data['informasi'])) {
            $data['pager'] = $informasiModel->pager;
        }
        return $this->loadView('frontend/beritama', $data);
    }

    public function pengumuman(): string
    {
        $informasiModel = new FrontendModel();

        // Pagination configuration
        $perPage = 3;
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;

        // Ambil data informasi berita
        $kategori = 'Pengumuman'; // Kategori yang ingin ditampilkan
        $totalRows = $informasiModel->countInformasiByKategori($kategori);

        // Pagination setup
        $data['informasi'] = $informasiModel->getInformasiByKategori($kategori, $perPage, ($currentPage - 1) * $perPage);
        $data['kategori'] = $informasiModel->getKategoriCount();

        // Ambil berita terbaru berdasarkan kategori
        $data['recentPosts'] = $informasiModel->getRecentPostsByKategori($kategori);

        // Ambil daftar tags dari semua informasi
        $tagsArray = [];
        foreach ($data['informasi'] as $info) {
            $tagsArray = array_merge($tagsArray, explode(',', $info['tags']));
        }
        $data['uniqueTags'] = array_unique($tagsArray);

        $data['title'] = 'Pengumuman- Disnakertrans Manokwari';

        // Set pager jika ada data
        if (!empty($data['informasi'])) {
            $data['pager'] = $informasiModel->pager;
        }
        return $this->loadView('frontend/pengumuman', $data);
    }

    public function pelatihan(): string
    {

        $informasiModel = new FrontendModel();

        // Pagination configuration
        $perPage = 3;
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;

        // Ambil data informasi berita
        $kategori = 'Pelatihan'; // Kategori yang ingin ditampilkan
        $totalRows = $informasiModel->countInformasiByKategori($kategori);

        // Pagination setup
        $data['informasi'] = $informasiModel->getInformasiByKategori($kategori, $perPage, ($currentPage - 1) * $perPage);
        $data['kategori'] = $informasiModel->getKategoriCount();

        // Ambil berita terbaru berdasarkan kategori
        $data['recentPosts'] = $informasiModel->getRecentPostsByKategori($kategori);

        // Ambil daftar tags dari semua informasi
        $tagsArray = [];
        foreach ($data['informasi'] as $info) {
            $tagsArray = array_merge($tagsArray, explode(',', $info['tags']));
        }
        $data['uniqueTags'] = array_unique($tagsArray);

        $data['title'] = 'Pelatihan - Disnakertrans Manokwari';

        // Set pager jika ada data
        if (!empty($data['informasi'])) {
            $data['pager'] = $informasiModel->pager;
        }

        return $this->loadView('frontend/pelatihan', $data);
    }

    public function kartu_ak1(): string
    {
        $data['title'] = 'Kartu Pencaker - Disnakertrans Manokwari';
        return $this->loadView('frontend/kartu_ak1', $data);
    }

    public function registrasi_pencaker(): string
    {
        $data['title'] = 'Registrasi Pencaker - Disnakertrans Manokwari';
        return $this->loadView('frontend/registrasi_pencaker', $data);
        // check if already logged in.

    }

    // public function save_pencaker_data_old()
    // {
    //     $request = service('request');

    //     // Ambil data dari form
    //     $nama_lengkap = $request->getPost('namalengkap');
    //     $nik = $request->getPost('nik');
    //     $email = $request->getPost('email');
    //     $no_hp = $request->getPost('nohp');
    //     $password = $request->getPost('password');

    //     // Simpan data ke tabel users
    //     $usersModel = new UsersModel();
    //     $usersData = [
    //         'name' => $nama_lengkap,
    //         'email' => $email,
    //         'password_hash' => password_hash($password, PASSWORD_DEFAULT), // Sesuaikan dengan field password_hash
    //         // 'phone' => $no_hp,
    //         'active' => 1, // Pastikan user aktif
    //         'status' => 'active', // Atau sesuaikan dengan status yang digunakan
    //         'created_at' => date('Y-m-d H:i:s'), // Tambahkan waktu pembuatan
    //         'updated_at' => date('Y-m-d H:i:s'), // Tambahkan waktu pembaruan
    //         // tambahkan field lainnya yang sesuai dengan form registrasi
    //     ];
    //     $userId = $usersModel->saveUser($usersData); // Simpan data user dan ambil ID-nya

    //     // Simpan data ke tabel pencaker
    //     $pencakerModel = new PencakerModel();
    //     $pencakerData = [
    //         'namalengkap' => $nama_lengkap,
    //         'nik' => $nik,
    //         'nohp' => $no_hp,
    //         'users_id' => $userId // Gunakan ID pengguna yang baru saja disimpan
    //     ];
    //     $pencakerModel->savePencaker($pencakerData);

    //     // Response
    //     $response = [
    //         'status' => 'success',
    //         'message' => 'Data berhasil disimpan.'
    //     ];
    //     return $this->response->setJSON($response);
    // }

    // public function save_pencaker_data()
    // {
    //     helper(['form', 'url']);
    //     $request = service('request');

    //     // Validasi input
    //     $validation = \Config\Services::validation();
    //     $validation->setRules([
    //         'namalengkap' => 'required',
    //         'nik' => 'required',
    //         'email' => 'required|valid_email',
    //         'nohp' => 'required',
    //         'password' => 'required|min_length[8]',
    //         'pass_confirm' => 'required|matches[password]',
    //     ]);

    //     if (!$validation->withRequest($this->request)->run()) {
    //         // Jika validasi gagal
    //         return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    //     }

    //     // Ambil data dari form
    //     $nama_lengkap = $request->getPost('namalengkap');
    //     $user_name = $request->getPost('username');
    //     $nik = $request->getPost('nik');
    //     $email = $request->getPost('email');
    //     $no_hp = $request->getPost('nohp');
    //     $password = $request->getPost('password');

    //     // Generate activate hash
    //     $activate_hash = bin2hex(random_bytes(16));

    //     // Simpan data ke tabel users
    //     $usersModel = new UsersModel();
    //     $usersData = [
    //         'username' => $user_name,
    //         'email' => $email,
    //         'password_hash' => password_hash($password, PASSWORD_DEFAULT), // Hash password
    //         // 'phone' => $no_hp,
    //         'active' => 1, // Pastikan user aktif
    //         'status' => 1, // Sesuaikan dengan status yang digunakan
    //         'activate_hash' => $activate_hash,
    //         'created_at' => date('Y-m-d H:i:s'), // Tambahkan waktu pembuatan
    //         'updated_at' => date('Y-m-d H:i:s'), // Tambahkan waktu pembaruan
    //     ];
    //     $userId = $usersModel->insert($usersData); // Simpan data user dan ambil ID-nya

    //     // Simpan data ke tabel pencaker
    //     $pencakerModel = new PencakerModel();
    //     $pencakerData = [
    //         'namalengkap' => $nama_lengkap,
    //         'nik' => $nik,
    //         'nohp' => $no_hp,
    //         'users_id' => $userId // Gunakan ID pengguna yang baru saja disimpan
    //     ];
    //     $pencakerModel->insert($pencakerData);

    //     // Redirect ke halaman sukses atau login
    //     return redirect()->to('/login')->with('message', 'Registrasi berhasil. Silakan login.');
    // }


    public function kontak(): string
    {
        $data['title'] = 'Kontak - Disnakertrans Manokwari';
        return $this->loadView('frontend/kontak', $data);
    }

    public function login(): string
    {
        $data['title'] = 'Kontak - Disnakertrans Manokwari';
        return $this->loadView('frontend/login', $data);
    }

    private function loadView(string $viewName, array $data = []): string
    {
        $uri = service('uri');
        $segments = $uri->getSegments();

        $data['current_uris'] = [
            'segment_1' => isset($segments[0]) ? $segments[0] : '',
            'segment_2' => isset($segments[1]) ? $segments[1] : '',
            'segment_3' => isset($segments[2]) ? $segments[2] : '',
        ];

        // Handle root URL
        if ($uri->getPath() === '' || $uri->getPath() === '/') {
            $data['current_uris']['segment_1'] = 'home';
        }

        return view($viewName, $data);
    }


    public function kartu($id)
    {
        log_message('debug', 'Metode kartu dipanggil dengan ID: ' . $id);
        $model = new PencakerModel();
        $data['pencari_kerja'] = $model->find($id);

        if (empty($data['pencari_kerja'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pencari Kerja tidak ditemukan');
        }

        $url = base_url('pencari_kerja/detail/' . $id);
        $data['qr_code'] = QrCodeHelper::generate($url);

        return view('frontend/kartu', $data); // Pastikan view path sesuai dengan struktur direktori Anda
    }
}
