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
$routes->get('/kontak', 'Frontend::kontak');
$routes->get('/masuk', 'Frontend::masuk');

$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('admin/pencaker', 'Admin::pencaker');
$routes->get('admin/berita', 'Admin::berita');
$routes->get('admin/pengumuman', 'Admin::pengumuman');
$routes->get('admin/pelatihan', 'Admin::pelatihan');
$routes->get('admin/userslog', 'Admin::userslog');
$routes->get('admin/users', 'Admin::users');
$routes->get('admin/settings', 'Admin::settings');
$routes->get('admin/backup', 'Admin::backup');
$routes->get('frontend/home', 'Frontend::index');
