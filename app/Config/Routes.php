<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');

$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/dashboard/getKakDataJson', 'Home::getKakDataJson');
$routes->get('/dashboard/getLpjDataJson', 'Home::getLpjDataJson');
$routes->get('/dashboard/getKakSelesaiDataJson', 'Home::getKakSelesaiDataJson');
$routes->get('/dashboard/getPieUnit', 'Home::getPieUnit');
$routes->get('/dashboard/kinerjaUnit', 'Home::kinerjaUnit');

$routes->get('/users', 'Users::index');
$routes->get('/users/tambah', 'Users::tambah');
$routes->post('/users/tambah', 'Users::simpan');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/update', 'Users::update');
$routes->get('/users/hapus/(:num)', 'Users::hapus/$1');

$routes->get('/proker', 'Proker::index');
$routes->get('/proker/tambah', 'Proker::tambah');
$routes->post('/proker/tambah', 'Proker::simpan');
$routes->get('/proker/edit/(:num)', 'Proker::edit/$1');
$routes->post('/proker/update', 'Proker::update');
$routes->get('/proker/hapus/(:num)', 'Proker::delete/$1');

$routes->get('/karyawan', 'Karyawan::index');

$routes->get('/kak', 'KerangkaKerja::index');
$routes->get('/kak/tambah', 'KerangkaKerja::tambah');
$routes->post('/kak/tambah', 'KerangkaKerja::simpan');
$routes->get('/kak/detail/(:num)', 'KerangkaKerja::detail/$1');
$routes->get('/kak/edit/(:num)', 'KerangkaKerja::edit/$1');
$routes->post('/kak/update', 'KerangkaKerja::update');
$routes->get('/kak/hapus/(:num)', 'KerangkaKerja::hapus/$1');
$routes->post('/kak/validasi', 'KerangkaKerja::validasi');

$routes->get('/lpj', 'Lpj::index');
$routes->get('/lpj/tambah/(:num)', 'Lpj::tambah/$1');
$routes->post('/lpj/simpan', 'Lpj::simpan');
$routes->get('/lpj/detail/(:num)', 'Lpj::detail/$1');
$routes->get('/lpj/edit/(:num)', 'Lpj::edit/$1');
$routes->post('/lpj/update/', 'Lpj::update');
$routes->get('/lpj/hapus/(:num)', 'Lpj::hapus/$1');
$routes->post('/lpj/validasi', 'Lpj::validasi');
$routes->get('/lpj/riwayat', 'Lpj::riwayatLpj');

