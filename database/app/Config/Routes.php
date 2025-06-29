<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Login & Logout (tanpa middleware)
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginProcess');
$routes->get('logout', 'Auth::logout');

// Grup yang hanya bisa diakses setelah login
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');

    // Data buku
    $routes->get('buku', 'Buku::index');
    $routes->get('buku/tambah', 'Buku::tambah');
    $routes->post('buku/simpan', 'Buku::simpan');
    $routes->get('buku/edit/(:num)', 'Buku::edit/$1');
    $routes->post('buku/update/(:num)', 'Buku::update/$1');
    $routes->get('buku/hapus/(:num)', 'Buku::hapus/$1');

    // Peminjaman oleh user
    $routes->get('peminjaman', 'Peminjaman::index');
    $routes->post('peminjaman/simpan', 'Peminjaman::simpan');
    $routes->get('peminjaman/riwayat', 'Peminjaman::riwayat');
    $routes->get('peminjaman/kembalikan/(:num)', 'Peminjaman::kembalikan/$1');
});

// Grup khusus admin
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    // Manajemen User (hanya admin)
    $routes->get('users', 'User::index');
    $routes->get('users/tambah', 'User::tambah');
    $routes->post('users/simpan', 'User::simpan');
    $routes->get('users/edit/(:num)', 'User::edit/$1');
    $routes->post('users/update/(:num)', 'User::update/$1');
    $routes->get('users/hapus/(:num)', 'User::hapus/$1');
    // Export Peminjaman (hanya admin)
    $routes->get('peminjaman', 'Peminjaman::semua');
    $routes->get('peminjaman/export', 'Peminjaman::exportPdf');
});

