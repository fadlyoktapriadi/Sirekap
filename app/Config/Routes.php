<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->get('/profile', 'Home::profile');
$routes->post('/profile/update', 'Home::profileUpdate');

$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/dashboard/getKakDataJson/(:any)', 'Home::getKakDataJson/$1');
$routes->get('/dashboard/getLpjDataJson/(:any)', 'Home::getLpjDataJson/$1');
$routes->get('/dashboard/getKakSelesaiDataJson/(:any)', 'Home::getKakSelesaiDataJson/$1');
$routes->get('/dashboard/getPieUnit', 'Home::getPieUnit');
$routes->get('/dashboard/kinerjaUnit', 'Home::kinerjaUnit');

$routes->get('/users', 'Users::index');
$routes->get('/users/tambah', 'Users::tambah');
$routes->post('/users/tambah', 'Users::simpan');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/update', 'Users::update');
$routes->get('/users/hapus/(:num)', 'Users::hapus/$1');

$routes->get('/pagu-anggaran', 'PaguAnggaran::index');
$routes->get('/pagu-anggaran/tambah', 'PaguAnggaran::tambah');
$routes->post('/pagu-anggaran/simpan', 'PaguAnggaran::simpan');
$routes->get('/pagu-anggaran/edit/(:num)', 'PaguAnggaran::edit/$1');
$routes->post('/pagu-anggaran/update', 'PaguAnggaran::update');
$routes->get('/pagu-anggaran/hapus/(:num)', 'PaguAnggaran::hapus/$1');

$routes->get('/karyawan', 'Karyawan::index');

$routes->get('/kak', 'KerangkaKerja::index');
$routes->post('/kak/filter', 'KerangkaKerja::filter');
$routes->get('/kak/tambah', 'KerangkaKerja::tambah');
$routes->post('/kak/tambah', 'KerangkaKerja::simpan');
$routes->get('/kak/detail/(:num)', 'KerangkaKerja::detail/$1');
$routes->get('/kak/edit/(:num)', 'KerangkaKerja::edit/$1');
$routes->post('/kak/update', 'KerangkaKerja::update');
$routes->get('/kak/hapus/(:num)', 'KerangkaKerja::hapus/$1');
$routes->post('/kak/validasi', 'KerangkaKerja::validasi');

$routes->get('/lpj', 'Lpj::index');
$routes->get('/lpj/batal/(:num)', 'Lpj::batal/$1');
$routes->post('/lpj/filter', 'Lpj::filter');
$routes->get('/lpj/tambah/(:num)', 'Lpj::tambah/$1');
$routes->post('/lpj/simpan', 'Lpj::simpan');
$routes->get('/lpj/detail/(:num)', 'Lpj::detail/$1');
$routes->get('/lpj/edit/(:num)', 'Lpj::edit/$1');
$routes->post('/lpj/update/', 'Lpj::update');
$routes->get('/lpj/hapus/(:num)', 'Lpj::hapus/$1');
$routes->post('/lpj/validasi', 'Lpj::validasi');
$routes->get('/lpj/riwayat', 'Lpj::riwayatLpj');
$routes->post('/lpj/riwayat/filter', 'Lpj::riwayatLpjFilter');

$routes->get('/laporan/realisasi-kegiatan', 'Laporan::realisasiKegiatan');
$routes->get('/laporan/detail-realisasi-kegiatan', 'Laporan::kegiatan');
$routes->get('/laporan/realisasi-anggaran', 'Laporan::anggaran');

$routes->set404Override('App\Controllers\Home::show404');
