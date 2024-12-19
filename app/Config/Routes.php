<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');

$routes->get('/dashboard', 'Home::dashboard');

$routes->get('/users', 'Users::index');
$routes->get('/users/tambah', 'Users::tambah');
$routes->post('/users/tambah', 'Users::simpan');
$routes->get('/users/cari', 'Users::cari');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/update', 'Users::update/$1');
$routes->get('/users/hapus/(:num)', 'Users::hapus/$1');
