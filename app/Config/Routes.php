<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::prosesLogin');
$routes->get('/logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('barang', 'Barang::index');
    $routes->get('barang/tambah', 'Barang::create');
    $routes->post('barang/tambah', 'Barang::store');
    $routes->get('barang/edit/(:num)', 'Barang::edit/$1');
    $routes->post('barang/update/(:num)', 'Barang::update/$1');
    $routes->get('barang/hapus/(:num)', 'Barang::delete/$1');
    $routes->get('/transaksi/masuk', 'Transaksi::masuk');
    $routes->post('/transaksi/masuk', 'Transaksi::storeMasuk');
    $routes->get('/transaksi/keluar', 'Transaksi::keluar');
    $routes->post('/transaksi/keluar', 'Transaksi::storeKeluar');
    $routes->get('/laporan', 'Laporan::index');
    $routes->post('/laporan/hasil', 'Laporan::hasil');
    $routes->get('/laporan/exportPdf', 'Laporan::exportPdf');
});
