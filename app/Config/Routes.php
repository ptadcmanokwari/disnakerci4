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



$routes->get('admin_v2', 'Admin::index', ['filter' => 'role:administrator']);
$routes->get('admin_v2', 'Admin::redirectDashboard');
$routes->get('admin_v2/dashboard', 'Admin::index', ['filter' => 'role:administrator']);

$routes->get('admin_v2/pencaker', 'Admin::pencaker', ['filter' => 'role:administrator']);
$routes->get('admin_v2/pencakerajax', 'Admin::pencakerajax', ['filter' => 'role:administrator']);
$routes->post('admin_v2/pencakerajax', 'Admin::pencakerajax', ['filter' => 'role:administrator']);
$routes->post('admin_v2/update_status_pencaker', 'Admin::update_status_pencaker', ['filter' => 'role:administrator']);
$routes->post('admin_v2/hapus_pencaker', 'Admin::hapus_pencaker', ['filter' => 'role:administrator']);
$routes->get('admin_v2/hapus_pencaker', 'Admin::hapus_pencaker', ['filter' => 'role:administrator']);
$routes->get('admin_v2/detail_pencaker/(:num)', 'Admin::detail_pencaker/$1', ['filter' => 'role:administrator']);
$routes->get('admin_v2/kartu_ak1/(:num)', 'Admin::kartu_ak1/$1', ['filter' => 'role:administrator']);

// Profil Pencaker
$routes->get('admin_v2/update1', 'Admin::update1', ['filter' => 'role:administrator']);
$routes->get('admin_v2/getTujuan', 'Admin::getTujuan', ['filter' => 'role:administrator']);
$routes->post('admin_v2/update1', 'Admin::update1', ['filter' => 'role:administrator']);


// Routes Berita
$routes->get('admin_v2/berita', 'Admin::berita', ['filter' => 'role:administrator']);
$routes->get('admin_v2/beritaajax', 'Admin::beritaajax', ['filter' => 'role:administrator']);
$routes->post('admin_v2/beritaajax', 'Admin::beritaajax', ['filter' => 'role:administrator']);
$routes->get('admin_v2/save_berita', 'Admin::save_berita', ['filter' => 'role:administrator']);
$routes->post('admin_v2/save_berita', 'Admin::save_berita', ['filter' => 'role:administrator']);
$routes->post('admin_v2/update_berita', 'Admin::update_berita', ['filter' => 'role:administrator']);
$routes->post('admin_v2/update_status_berita', 'Admin::update_status_berita', ['filter' => 'role:administrator']);
$routes->post('admin_v2/hapus_berita', 'Admin::hapus_berita', ['filter' => 'role:administrator']);

// Routes Pengumuman
$routes->get('admin_v2/pengumuman', 'Admin::pengumuman', ['filter' => 'role:administrator']);
$routes->get('admin_v2/pengumumanajax', 'Admin::pengumumanajax', ['filter' => 'role:administrator']);
$routes->post('admin_v2/pengumumanajax', 'Admin::pengumumanajax', ['filter' => 'role:administrator']);
$routes->post('admin_v2/save_pengumuman', 'Admin::save_pengumuman', ['filter' => 'role:administrator']);
$routes->post('admin_v2/update_pengumuman', 'Admin::update_pengumuman', ['filter' => 'role:administrator']);
$routes->post('admin_v2/update_status_pengumuman', 'Admin::update_status_pengumuman', ['filter' => 'role:administrator']);
$routes->post('admin_v2/hapus_pengumuman', 'Admin::hapus_pengumuman', ['filter' => 'role:administrator']);

// Routes Pelatihan
$routes->get('admin_v2/pelatihan', 'Admin::pelatihan', ['filter' => 'role:administrator']);
$routes->get('admin_v2/pelatihanajax', 'Admin::pelatihanajax', ['filter' => 'role:administrator']);
$routes->post('admin_v2/pelatihanajax', 'Admin::pelatihanajax', ['filter' => 'role:administrator']);
$routes->post('admin_v2/save_pelatihan', 'Admin::save_pelatihan', ['filter' => 'role:administrator']);
$routes->post('admin_v2/update_pelatihan', 'Admin::update_pelatihan', ['filter' => 'role:administrator']);
$routes->post('admin_v2/update_status_pelatihan', 'Admin::update_status_pelatihan', ['filter' => 'role:administrator']);
$routes->post('admin_v2/hapus_pelatihan', 'Admin::hapus_pelatihan', ['filter' => 'role:administrator']);

// $routes->get('admin_v2/userslog', 'Admin::userslog', ['filter' => 'role:administrator']);
$routes->get('admin_v2/activitylogs', 'Admin::activitylogs', ['filter' => 'role:administrator']);
$routes->get('admin_v2/activitylogsajax', 'Admin::activitylogsajax', ['filter' => 'role:administrator']);
$routes->post('admin_v2/activitylogsajax', 'Admin::activitylogsajax', ['filter' => 'role:administrator']);
$routes->get('admin_v2/getUsers', 'Admin::getUsers', ['filter' => 'role:administrator']);

// Users
$routes->get('admin_v2/users', 'Admin::users', ['filter' => 'role:administrator']);
$routes->get('admin_v2/usersajax', 'Admin::usersajax', ['filter' => 'role:administrator']);
$routes->post('admin_v2/usersajax', 'Admin::usersajax', ['filter' => 'role:administrator']);
$routes->post('admin_v2/update_status_user', 'Admin::update_status_user', ['filter' => 'role:administrator']);
$routes->post('admin_v2/hapus_user', 'Admin::hapus_user', ['filter' => 'role:administrator']);
$routes->get('admin_v2/hapus_user', 'Admin::hapus_user', ['filter' => 'role:administrator']);

$routes->get('admin_v2/settings', 'Admin::settings', ['filter' => 'role:administrator']);
$routes->get('admin_v2/backup', 'Admin::backup', ['filter' => 'role:administrator']);

// Export Data
$routes->get('admin_v2/downloadexcel', 'Admin::exportExcel', ['filter' => 'role:administrator']);
$routes->get('admin_v2/downloadpdf', 'Admin::exportPDF', ['filter' => 'role:administrator']);


$routes->get('admin_v2/profil_pencaker', 'Admin::profil_pencaker', ['filter' => 'role:administrator']);
// $routes->get('admin_v2/form', 'Admin::form', ['filter' => 'role:administrator']);

$routes->get('admin_v2/backup', 'Admin::backup', ['filter' => 'role:administrator']);
$routes->post('admin_v2/download_db', 'Admin::download_db', ['filter' => 'role:administrator']);


$routes->get('pencaker', 'Pencaker::index');
$routes->get('pencaker/dashboard', 'Pencaker::index');

$routes->get('admin_v2', 'Admin::redirectDashboard');
$routes->get('admin_v2/dashboard', 'Admin::index');


// ROUTES UNTUK PENCAKER
$routes->get('pencaker', 'Pencaker::index', ['filter' => 'role:pencaker']);
$routes->get('pencaker/dashboard', 'Pencaker::index', ['filter' => 'role:pencaker']);
$routes->get('pencaker/profil_pencaker', 'Admin::profil_pencaker', ['filter' => 'role:pencaker']);

// Dokumen Pencaker
$routes->get('pencaker/dokumen_pencaker', 'Admin::dokumen_pencaker', ['filter' => 'role:pencaker']);
$routes->post('pencaker/dokajax', 'Admin::dokajax', ['filter' => 'role:pencaker']);
$routes->get('pencaker/upload_dokumen', 'Admin::upload_dokumen', ['filter' => 'role:pencaker']);
$routes->post('pencaker/upload_dokumen', 'Admin::upload_dokumen', ['filter' => 'role:pencaker']);
$routes->post('pencaker/hapus_dokumen', 'Admin::hapus_dokumen', ['filter' => 'role:pencaker']);

// Update Profil Pencaker
// tujuan pencaker
$routes->post('pencaker/save_data_tujuan', 'Admin::save_data_tujuan', ['filter' => 'role:pencaker']);
$routes->get('pencaker/get_data_tujuan/(:num)', 'Admin::get_data_tujuan/$1');

// keterangan umum
$routes->post('pencaker/save_data_keterangan_umum', 'Admin::save_data_keterangan_umum', ['filter' => 'role:pencaker']);
$routes->get('pencaker/get_data_keterangan_umum/(:num)', 'Admin::get_data_keterangan_umum/$1');

// data pendidikan
$routes->post('pencaker/save_data_pendidikan', 'Admin::save_data_pendidikan', ['filter' => 'role:pencaker']);
$routes->get('pencaker/save_data_pendidikan/(:num)', 'Admin::save_data_pendidikan/$1');
$routes->post('pencaker/fetch_data_pendidikan', 'Admin::fetch_data_pendidikan');
$routes->post('pencaker/hapus_data_pendidikan', 'Admin::hapus_data_pendidikan', ['filter' => 'role:pencaker']);
$routes->get('pencaker/update_data_pendidikan', 'Admin::update_data_pendidikan', ['filter' => 'role:pencaker']);
$routes->post('pencaker/update_data_pendidikan', 'Admin::update_data_pendidikan', ['filter' => 'role:pencaker']);
$routes->post('pencaker/get_pendidikan_by_id', 'Admin::get_pendidikan_by_id', ['filter' => 'role:pencaker']);

//
$routes->get('pencaker/getPencakerData', 'Admin::getPencakerData', ['filter' => 'role:pencaker']);


$routes->post('pencaker/save_data_bahasa', 'Admin::save_data_bahasa', ['filter' => 'role:pencaker']);
$routes->get('pencaker/save_data_bahasa', 'Admin::save_data_bahasa', ['filter' => 'role:pencaker']);
// $routes->get('pencaker/get_data_bahasa/(:num)', 'Admin::get_data_bahasa/$1');
// $routes->get('admin/profil_pencaker/(:num)', 'Admin::profil_pencaker/$1');
// $routes->get('admin/getPencakerData/(:num)', 'Admin::getPencakerData/$1');

// // ROUTES UNTUK ADMIN
// $routes->get('admin', 'Admin::index', ['filter' => 'role:administrator']);
// $routes->get('admin/dashboard', 'Admin::index', ['filter' => 'role:administrator']);
// $routes->get('admin/pencaker', 'Admin::pencaker', ['filter' => 'role:administrator']);
// $routes->get('pencaker/form', 'Admin::form', ['filter' => 'role:pencaker']);


// Data Pengalaman Kerja
$routes->post('pencaker/save_data_pengalaman_kerja', 'Admin::save_data_pengalaman_kerja', ['filter' => 'role:pencaker']);
$routes->get('pencaker/save_data_pengalaman_kerja/(:num)', 'Admin::save_data_pengalaman_kerja/$1');
$routes->post('pencaker/fetch_data_pengalaman_kerja', 'Admin::fetch_data_pengalaman_kerja');
$routes->post('pencaker/hapus_data_pengalaman_kerja', 'Admin::hapus_data_pengalaman_kerja', ['filter' => 'role:pencaker']);
$routes->get('pencaker/update_data_pengalaman_kerja', 'Admin::update_data_pengalaman_kerja', ['filter' => 'role:pencaker']);
$routes->post('pencaker/update_data_pengalaman_kerja', 'Admin::update_data_pengalaman_kerja', ['filter' => 'role:pencaker']);
$routes->post('pencaker/get_pengalaman_kerja_by_id', 'Admin::get_pengalaman_kerja_by_id', ['filter' => 'role:pencaker']);

// Minat Jabatan
$routes->post('pencaker/save_data_minat_jabatan', 'Admin::save_data_minat_jabatan', ['filter' => 'role:pencaker']);
$routes->get('pencaker/save_data_minat_jabatan/(:num)', 'Admin::save_data_minat_jabatan/$1');
$routes->post('pencaker/fetch_data_minat_jabatan', 'Admin::fetch_data_minat_jabatan');
$routes->post('pencaker/hapus_data_minat_jabatan', 'Admin::hapus_data_minat_jabatan', ['filter' => 'role:pencaker']);
$routes->get('pencaker/update_data_minat_jabatan', 'Admin::update_data_minat_jabatan', ['filter' => 'role:pencaker']);
$routes->post('pencaker/update_data_minat_jabatan', 'Admin::update_data_minat_jabatan', ['filter' => 'role:pencaker']);
$routes->post('pencaker/get_minat_jabatan_by_id', 'Admin::get_minat_jabatan_by_id', ['filter' => 'role:pencaker']);

// Perusahaan Tujuan
$routes->post('pencaker/save_data_perusahaan_tujuan', 'Admin::save_data_perusahaan_tujuan', ['filter' => 'role:pencaker']);
$routes->get('pencaker/save_data_perusahaan_tujuan/(:num)', 'Admin::save_data_perusahaan_tujuan/$1');
$routes->post('pencaker/get_perusahaan_tujuan_by_id', 'Admin::get_perusahaan_tujuan_by_id', ['filter' => 'role:pencaker']);
$routes->get('pencaker/get_perusahaan_tujuan_by_id/(:num)', 'Admin::get_perusahaan_tujuan_by_id/$1', ['filter' => 'role:pencaker']);


// Catatan tambahan
$routes->post('pencaker/save_catatan_pengantar', 'Admin::save_catatan_pengantar', ['filter' => 'role:pencaker']);
$routes->get('pencaker/save_catatan_pengantar/(:num)', 'Admin::save_catatan_pengantar/$1');
$routes->post('pencaker/get_catatan_pengantar_by_id', 'Admin::get_catatan_pengantar_by_id', ['filter' => 'role:pencaker']);
$routes->get('pencaker/get_catatan_pengantar_by_id/(:num)', 'Admin::get_catatan_pengantar_by_id/$1', ['filter' => 'role:pencaker']);


// Bahasa
$routes->post('pencaker/save_bahasa', 'Admin::save_bahasa');
$routes->get('pencaker/get_bahasa_pencaker_by_id/(:num)', 'Admin::get_bahasa_pencaker_by_id/$1');


// Sidebar pengaturan
$routes->get('pencaker/pengaturan', 'Admin::pengaturan', ['filter' => 'role:pencaker']);

$routes->get('notification', 'NotificationController::sendNotification');
