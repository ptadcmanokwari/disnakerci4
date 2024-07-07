<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//route untuk frontend
$routes->get('/', 'Frontend::index');
$routes->get('profil', 'Frontend::profil');
$routes->get('urusan_transmigrasi', 'Frontend::transmigrasi');
$routes->get('urusan_tenaga_kerja', 'Frontend::tenaga_kerja');
$routes->get('berita', 'Frontend::berita');
$routes->get('pengumuman', 'Frontend::pengumuman');
$routes->get('pelatihan', 'Frontend::pelatihan');
$routes->get('kartu_ak1', 'Frontend::kartu_ak1');
$routes->get('kontak', 'Frontend::kontak');
//proses registrasi akun bagi pencaker
$routes->get('/registrasi_pencaker', 'Frontend::registrasi_pencaker');
$routes->post('/registrasi_pencaker', 'Frontend::registrasi_pencaker');
$routes->post('/frontend/save_pencaker_data', 'Frontend::save_pencaker_data');
$routes->get('/masuk', 'Frontend::login');


//routes untuk admin
$routes->get('admin', 'Admin::index');
//menu dashboard
$routes->get('admin/dashboard', 'Admin::dashboard');
//menu pencaker
$routes->get('admin/pencaker', 'Admin::pencaker');
//menu informasi web - berita
$routes->get('admin/berita', 'Admin::berita');
$routes->post('admin/berita_ajax', 'Admin::berita_ajax');
$routes->get('admin/berita_ajax', 'Admin::berita_ajax');
$routes->post('admin/hapus_berita', 'Admin::hapus_berita');
$routes->post('admin/upload_berita', 'Admin::upload_berita');
$routes->get('admin/upload_berita', 'Admin::upload_berita');
$routes->get('admin/get_berita/(:num)', 'Admin::get_berita/$1');
$routes->get('admin/update_berita', 'Admin::update_berita');
$routes->post('admin/update_berita', 'Admin::update_berita');
$routes->post('admin/upload_gambar', 'Admin::upload_gambar');
$routes->post('admin/upload_berita', 'Admin::upload_berita');
$routes->get('admin/upload_berita', 'Admin::upload_berita');
//menu informasi web - pengumuman
$routes->get('admin/pengumuman', 'Admin::pengumuman');
//menu informasi web - pelatihan
$routes->get('admin/pelatihan', 'Admin::pelatihan');
//menu aktivitas pengguna
$routes->get('admin/userslog', 'Admin::userslog');

//routes untuk super admin
//menu users
$routes->get('admin/users', 'Admin::users');
//menu settings
$routes->get('admin/settings', 'Admin::settings');
//menu backup
$routes->get('admin/backup', 'Admin::backup');

//routes untuk user / pencaker