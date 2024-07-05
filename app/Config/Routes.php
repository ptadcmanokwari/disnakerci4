<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('admin', 'Admin::index');
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