<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');

$routes->get('/dashboard', 'Home::dashboard');

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

$routes->get('/karyawan', 'Users::karyawan');

$routes->get('/kak', 'KerangkaKerja::index');
$routes->get('/kak/tambah', 'KerangkaKerja::tambah');
$routes->post('/kak/tambah', 'KerangkaKerja::simpan');

