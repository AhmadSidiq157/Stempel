<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rute default, mengarah ke halaman depan untuk pelanggan
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Rute Tambahan
 * --------------------------------------------------------------------
 */

// Rute untuk menampilkan gambar dari folder `writable`
$routes->get('uploads/(:segment)/(:segment)', 'App\Controllers\UploadController::show/$1/$2');

/*
 * --------------------------------------------------------------------
 * Rute Autentikasi (Login & Logout)
 * --------------------------------------------------------------------
 */
$routes->get('login', 'AuthController::index');
$routes->post('auth/login', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');


/*
 * --------------------------------------------------------------------
 * Rute Panel Admin (Dilindungi oleh Filter)
 * --------------------------------------------------------------------
 */
$routes->group('admin', function ($routes) {
    
    // Rute untuk Dashboard Admin
    $routes->get('/', 'Admin\DashboardController::index');

    // --- Rute untuk CRUD Kategori ---
    $routes->get('kategori', 'Admin\KategoriController::index');
    $routes->get('kategori/create', 'Admin\KategoriController::create');
    $routes->post('kategori/store', 'Admin\KategoriController::store');
    $routes->get('kategori/edit/(:num)', 'Admin\KategoriController::edit/$1');
    $routes->post('kategori/update/(:num)', 'Admin\KategoriController::update/$1');
    $routes->get('kategori/delete/(:num)', 'Admin\KategoriController::delete/$1');

    // --- Rute untuk CRUD Produk ---
    $routes->get('produk', 'Admin\ProdukController::index');
    $routes->get('produk/create', 'Admin\ProdukController::create');
    $routes->post('produk/store', 'Admin\ProdukController::store');
    $routes->get('produk/edit/(:num)', 'Admin\ProdukController::edit/$1');
    $routes->post('produk/update/(:num)', 'Admin\ProdukController::update/$1');
    $routes->get('produk/delete/(:num)', 'Admin\ProdukController::delete/$1');


    // --- Rute untuk CRUD Pesanan ---
    $routes->get('pesanan', 'Admin\PesananController::index');
    $routes->get('pesanan/create', 'Admin\PesananController::create');
    $routes->post('pesanan/store', 'Admin\PesananController::store');
    $routes->get('pesanan/edit/(:num)', 'Admin\PesananController::edit/$1');
    $routes->post('pesanan/update/(:num)', 'Admin\PesananController::update/$1');
    $routes->get('pesanan/delete/(:num)', 'Admin\PesananController::delete/$1');

});
