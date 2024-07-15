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

$routes->get('admin', 'Admin::index', ['filter' => 'role:admin, superadmin']);
$routes->get('admin', 'Admin::redirectDashboard');
$routes->get('admin/dashboard', 'Admin::index', ['filter' => 'role:admin, superadmin']);

$routes->get('admin/pencaker', 'Admin::pencaker', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/pencakerajax', 'Admin::pencakerajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/pencakerajax', 'Admin::pencakerajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/update_status_pencaker', 'Admin::update_status_pencaker', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/hapus_pencaker', 'Admin::hapus_pencaker', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/hapus_pencaker', 'Admin::hapus_pencaker', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/detail_pencaker/(:num)', 'Admin::detail_pencaker/$1', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/kartu_ak1/(:num)', 'Admin::kartu_ak1/$1', ['filter' => 'role:admin, superadmin']);

// Profil Pencaker
$routes->get('admin/update1', 'Admin::update1', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/getTujuan', 'Admin::getTujuan', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/update1', 'Admin::update1', ['filter' => 'role:admin, superadmin']);


// Routes Berita
$routes->get('admin/berita', 'Admin::berita', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/beritaajax', 'Admin::beritaajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/beritaajax', 'Admin::beritaajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/save_berita', 'Admin::save_berita', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/update_berita', 'Admin::update_berita', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/update_status_berita', 'Admin::update_status_berita', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/hapus_berita', 'Admin::hapus_berita', ['filter' => 'role:admin, superadmin']);

// Routes Pengumuman
$routes->get('admin/pengumuman', 'Admin::pengumuman', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/pengumumanajax', 'Admin::pengumumanajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/pengumumanajax', 'Admin::pengumumanajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/save_pengumuman', 'Admin::save_pengumuman', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/update_pengumuman', 'Admin::update_pengumuman', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/update_status_pengumuman', 'Admin::update_status_pengumuman', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/hapus_pengumuman', 'Admin::hapus_pengumuman', ['filter' => 'role:admin, superadmin']);

// Routes Pelatihan
$routes->get('admin/pelatihan', 'Admin::pelatihan', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/pelatihanajax', 'Admin::pelatihanajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/pelatihanajax', 'Admin::pelatihanajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/save_pelatihan', 'Admin::save_pelatihan', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/update_pelatihan', 'Admin::update_pelatihan', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/update_status_pelatihan', 'Admin::update_status_pelatihan', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/hapus_pelatihan', 'Admin::hapus_pelatihan', ['filter' => 'role:admin, superadmin']);

// $routes->get('admin/userslog', 'Admin::userslog', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/activitylogs', 'Admin::activitylogs', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/activitylogsajax', 'Admin::activitylogsajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/activitylogsajax', 'Admin::activitylogsajax', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/getUsers', 'Admin::getUsers', ['filter' => 'role:admin, superadmin']);

// Users
$routes->get('admin/users', 'Admin::users', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/usersajax', 'Admin::usersajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/usersajax', 'Admin::usersajax', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/update_status_user', 'Admin::update_status_user', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/hapus_user', 'Admin::hapus_user', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/hapus_user', 'Admin::hapus_user', ['filter' => 'role:admin, superadmin']);

$routes->get('admin/settings', 'Admin::settings', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/backup', 'Admin::backup', ['filter' => 'role:admin, superadmin']);

// Export Data
$routes->get('admin/downloadexcel', 'Admin::exportExcel', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/downloadpdf', 'Admin::exportPDF', ['filter' => 'role:admin, superadmin']);


$routes->get('admin/profil_pencaker', 'Admin::profil_pencaker', ['filter' => 'role:admin, superadmin']);
$routes->get('admin/form', 'Admin::form', ['filter' => 'role:admin, superadmin']);

$routes->get('admin/backup', 'Admin::backup', ['filter' => 'role:admin, superadmin']);
$routes->post('admin/download_db', 'Admin::download_db', ['filter' => 'role:admin, superadmin']);


$routes->get('pencaker', 'Pencaker::index');
$routes->get('pencaker/dashboard', 'Pencaker::index');

// $routes->get('admin', 'Admin::redirectDashboard');
// $routes->get('admin/dashboard', 'Admin::index');
