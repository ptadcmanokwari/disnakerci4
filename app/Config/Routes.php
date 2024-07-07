<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('admin', 'Admin::index');

// frontend
$routes->get('/', 'Frontend::index');
$routes->get('/home', 'Frontend::index');
$routes->get('/profil', 'Frontend::profil');
$routes->get('/transmigrasi', 'Frontend::transmigrasi');
$routes->get('/tenaga_kerja', 'Frontend::tenaga_kerja');
$routes->get('/berita', 'Frontend::berita');
$routes->get('/pengumuman', 'Frontend::pengumuman');
$routes->get('/pelatihan', 'Frontend::pelatihan');
$routes->get('/kartu_ak1', 'Frontend::kartu_ak1');
$routes->get('/registrasi_pencaker', 'Frontend::registrasi_pencaker');
$routes->post('/registrasi_pencaker', 'Frontend::registrasi_pencaker');
$routes->post('frontend/save_pencaker_data', 'Frontend::save_pencaker_data');

$routes->get('/kontak', 'Frontend::kontak');
$routes->get('/masuk', 'Frontend::masuk');


$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('admin/pencaker', 'Admin::pencaker');
// $routes->get('admin/berita', 'Admin::berita');

$routes->get('/admin/berita', 'Admin::berita');
$routes->post('/admin/berita_ajax', 'Admin::berita_ajax');
$routes->get('/admin/berita_ajax', 'Admin::berita_ajax');
$routes->post('admin/hapus_berita', 'Admin::hapus_berita');
$routes->post('admin/upload_berita', 'Admin::upload_berita');
$routes->get('admin/upload_berita', 'Admin::upload_berita');

$routes->get('admin/get_berita/(:num)', 'Admin::get_berita/$1');
$routes->get('admin/update_berita', 'Admin::update_berita');
$routes->post('admin/update_berita', 'Admin::update_berita');
$routes->post('admin/upload_gambar', 'Admin::upload_gambar');
$routes->post('/admin/upload_berita', 'Admin::upload_berita');
$routes->get('/admin/upload_berita', 'Admin::upload_berita');


$routes->get('admin/pengumuman', 'Admin::pengumuman');
$routes->get('admin/pelatihan', 'Admin::pelatihan');
$routes->get('admin/userslog', 'Admin::userslog');
$routes->get('admin/users', 'Admin::users');
$routes->get('admin/settings', 'Admin::settings');
$routes->get('admin/backup', 'Admin::backup');
$routes->get('frontend/home', 'Frontend::index');
