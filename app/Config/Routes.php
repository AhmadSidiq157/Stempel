<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// $routes->setAutoRoute(true); // Sebaiknya false untuk keamanan


// Rute Halaman Depan (Customer)
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Rute Pemesanan oleh Pelanggan
 * --------------------------------------------------------------------
 */
// Menampilkan halaman form pemesanan untuk produk dengan ID tertentu
$routes->get('pesan/(:num)', 'PesananController::index/$1');
// Menyimpan data dari form pemesanan
$routes->post('pesan/simpan', 'PesananController::simpan');


/*
 * --------------------------------------------------------------------
 * Rute Autentikasi Admin
 * --------------------------------------------------------------------
 */
$routes->get('login', 'AuthController::index');
$routes->post('auth/login', 'AuthController::attemptLogin');
$routes->get('logout', 'AuthController::logout');


/*
 * --------------------------------------------------------------------
 * Rute Panel Admin
 * --------------------------------------------------------------------
 */
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    // Rute untuk Dashboard Admin
    $routes->get('/', 'DashboardController::index');

    // --- Rute untuk CRUD Kategori ---
    $routes->get('kategori', 'KategoriController::index');
    $routes->get('kategori/create', 'KategoriController::create');
    $routes->post('kategori/store', 'KategoriController::store');
    $routes->get('kategori/edit/(:num)', 'KategoriController::edit/$1');
    $routes->post('kategori/update/(:num)', 'KategoriController::update/$1');
    $routes->get('kategori/delete/(:num)', 'KategoriController::delete/$1');

    // --- Rute untuk CRUD Produk ---
    $routes->get('produk', 'ProdukController::index');
    $routes->get('produk/create', 'ProdukController::create');
    $routes->post('produk/store', 'ProdukController::store');
    $routes->get('produk/edit/(:num)', 'ProdukController::edit/$1');
    $routes->post('produk/update/(:num)', 'ProdukController::update/$1');
    $routes->get('produk/delete/(:num)', 'ProdukController::delete/$1');

    // --- Rute untuk Manajemen Pesanan (oleh Admin) ---
    $routes->get('pesanan', 'PesananController::index');
    $routes->get('pesanan/detail/(:num)', 'PesananController::detail/$1');
    $routes->post('pesanan/update_status/(:num)', 'PesananController::updateStatus/$1');
    $routes->get('pesanan/delete/(:num)', 'PesananController::delete/$1');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
