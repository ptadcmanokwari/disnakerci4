<?php

namespace App\Controllers;

use App\Models\FrontendModel;

class Frontend extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Beranda - Disnakertrans Manokwari';

        return $this->loadView('frontend/home', $data);
    }

    public function profil(): string
    {
        $data['title'] = 'Profil - Disnakertrans Manokwari';

        return $this->loadView('frontend/profil', $data);
    }

    public function transmigrasi(): string
    {
        $data['title'] = 'Urusan Transmigrasi - Disnakertrans Manokwari';
        return $this->loadView('frontend/transmigrasi', $data);
    }

    public function tenaga_kerja(): string
    {
        $data['title'] = 'Urusan Tenaga Kerja - Disnakertrans Manokwari';
        return $this->loadView('frontend/tenaga_kerja', $data);
    }

    public function berita(): string
    {
        $informasiModel = new FrontendModel();

        // Pagination configuration
        $perPage = 3;
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;

        // Ambil data informasi berita
        $kategori = 'berita'; // Kategori yang ingin ditampilkan
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

        $data['title'] = 'Urusan Tenaga Kerja - Disnakertrans Manokwari';

        // Set pager jika ada data
        if (!empty($data['informasi'])) {
            $data['pager'] = $informasiModel->pager;
        }

        return $this->loadView('frontend/berita', $data);
    }


    public function pengumuman(): string
    {
        $informasiModel = new FrontendModel();

        // Pagination configuration
        $perPage = 3;
        $currentPage = $this->request->getVar('page') ? (int)$this->request->getVar('page') : 1;

        // Ambil data informasi berita
        $kategori = 'pengumuman'; // Kategori yang ingin ditampilkan
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

        $data['title'] = 'Urusan Tenaga Kerja - Disnakertrans Manokwari';

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
        $kategori = 'pelatihan'; // Kategori yang ingin ditampilkan
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

        $data['title'] = 'Urusan Tenaga Kerja - Disnakertrans Manokwari';

        // Set pager jika ada data
        if (!empty($data['informasi'])) {
            $data['pager'] = $informasiModel->pager;
        }

        return $this->loadView('frontend/pelatihan', $data);
    }

    public function kartu_ak1(): string
    {
        $data['title'] = 'Urusan Tenaga Kerja - Disnakertrans Manokwari';
        return $this->loadView('frontend/kartu_ak1', $data);
    }

    public function registrasi_pencaker(): string
    {
        $data['title'] = 'Urusan Tenaga Kerja - Disnakertrans Manokwari';
        return $this->loadView('frontend/registrasi_pencaker', $data);
    }

    public function kontak(): string
    {
        $data['title'] = 'Urusan Tenaga Kerja - Disnakertrans Manokwari';
        return $this->loadView('frontend/kontak', $data);
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
}
