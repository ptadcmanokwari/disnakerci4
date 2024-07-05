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
$routes->get('/kontak', 'Frontend::kontak');
$routes->get('/masuk', 'Frontend::masuk');
