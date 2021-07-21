<?php

use Symfony\Component\Routing;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Core\GlobalFunc;

$routes = new RouteCollection();
$app = new GlobalFunc;

// ROUTE APPLICATION START BELOW!!! 
// --------------------------------

// $routes->add('welcome', new Route('/', [
//     '_controller' => function(Request $request) {
//         global $app;

//         return $app->render_template('welcome');
//     }
// ]));


//Login
$routes->add('base', new Route('/', [
    '_controller' => 'App\Login\Controller\LoginController::index',
]));
$routes->add('login', new Route('/login', [
    '_controller' => 'App\Login\Controller\LoginController::index',
]));
$routes->add('loginProses', new Route('/login/proses', [
    '_controller' => 'App\Login\Controller\LoginController::login_proses',
]));
$routes->add('logoutProses', new Route('/logout', [
    '_controller' => 'App\Login\Controller\LoginController::logout_proses',
]));

//Dashboard
$routes->add('dashboard', new Route('/dashboard', [
    '_controller' => 'App\Dashboard\Controller\DashboardController::index',
]));

//CRUD produk
$routes->add('produk', new Route('/produk', [
    '_controller' => 'App\Produk\Controller\ProdukController::index',
]));

$routes->add('produkcreate', new Route('/produk/create', [
    '_controller' => 'App\Produk\Controller\ProdukController::create',
]));

$routes->add('produksimpan', new Route('/produk/store', [
    '_controller' => 'App\Produk\Controller\ProdukController::store',
]));

$routes->add('produksedit', new Route('/produk/{id}/edit', [
    '_controller' => 'App\Produk\Controller\ProdukController::edit',
]));

$routes->add('produkupdate', new Route('/produk/{id}/update', [
    '_controller' => 'App\Produk\Controller\ProdukController::update',
]));

$routes->add('produkshapus', new Route('/produk/{id}/delete', [
    '_controller' => 'App\Produk\Controller\ProdukController::delete',
]));

$routes->add('produkgetall', new Route('/produk/get-all', [
    '_controller' => 'App\Produk\Controller\ProdukController::get_all',
]));

$routes->add('produkget', new Route('/produk/{id}/get', [
    '_controller' => 'App\Produk\Controller\ProdukController::get',
]));

$routes->add('produkactivity', new Route('/produk/{id}/activity', [
    '_controller' => 'App\Produk\Controller\ProdukController::activity',
]));
$routes->add('produkDataPerPage', new Route('/produk/create', [
    '_controller' => 'App\Produk\Controller\ProdukController::create',
]));

//User Management
$routes->add('users', new Route('/users', [
    '_controller' => 'App\Users\Controller\UsersController::index',
]));
$routes->add('usersCreate', new Route('/users/create', [
    '_controller' => 'App\Users\Controller\UsersController::create',
]));
$routes->add('usersStore', new Route('/users/store', [
    '_controller' => 'App\Users\Controller\UsersController::store',
]));
$routes->add('usersEdit', new Route('/users/{id_user}/edit', [
    '_controller' => 'App\Users\Controller\UsersController::edit',
]));
$routes->add('usersUpdate', new Route('/users/{id_user}/update', [
    '_controller' => 'App\Users\Controller\UsersController::update',
]));
$routes->add('usersDetail', new Route('/users/{id_user}/detail', [
    '_controller' => 'App\Users\Controller\UsersController::detail',
]));
$routes->add('usersDelete', new Route('/users/{id_user}/delete', [
    '_controller' => 'App\Users\Controller\UsersController::delete',
]));
$routes->add('usersGet', new Route('/users/{id_user}/get', [
    '_controller' => 'App\Users\Controller\UsersController::get',
]));
$routes->add('usersResetPassword', new Route('/users/{id_user}/reset-password', [
    '_controller' => 'App\Users\Controller\UsersController::reset_password',
]));
// profile
$routes->add('profile', new Route('/profile', [
    '_controller' => 'App\Users\Controller\UsersController::profile',
]));
// akun
$routes->add('akun', new Route('/akun', [
    '_controller' => 'App\Users\Controller\UsersController::akun',
]));
$routes->add('akunUpdate', new Route('/akun/{id_user}/update', [
    '_controller' => 'App\Users\Controller\UsersController::akun_update',
]));

// //Transaksi
// $routes->add('transaksi', new Route('/transaksi', [
//     '_controller' => 'App\Transaksi\Controller\TransaksiController::index'
// ]));
// $routes->add('transaksiCreate', new Route('/transaksi/create', [
//     '_controller' => 'App\Transaksi\Controller\TransaksiController::create'
// ]));
// $routes->add('transaksiStore', new Route('/transaksi/store', [
//     '_controller' => 'App\Transaksi\Controller\TransaksiController::store'
// ]));
// $routes->add('transaksiEdit', new Route('/transaksi/{idTransaksi}/edit', [
//     '_controller' => 'App\Transaksi\Controller\TransaksiController::edit'
// ]));
// $routes->add('transaksiUpdate', new Route('/transaksi/{idTransaksi}/update', [
//     '_controller' => 'App\Transaksi\Controller\TransaksiController::update'
// ]));
// $routes->add('transaksiDetail', new Route('/transaksi/{idTransaksi}/detail', [
//     '_controller' => 'App\Transaksi\Controller\TransaksiController::detail'
// ]));
// $routes->add('transaksiReceipt', new Route('/transaksi/{idTransaksi}/print-receipt', [
//     '_controller' => 'App\Transaksi\Controller\TransaksiController::print_receipt'
// ]));
// $routes->add('transaksiRetur', new Route('/transaksi/{idTransaksi}/retur', [
//     '_controller' => 'App\Transaksi\Controller\TransaksiController::retur'
// ]));
// $routes->add('transaksiReturStore', new Route('/transaksi/{idTransaksi}/retur-store', [
//     '_controller' => 'App\Transaksi\Controller\TransaksiController::retur_store'
// ]));
// $routes->add('transaksiGet', new Route('/transaksi/{idTransaksi}/get', [
//     '_controller' => 'App\Transaksi\Controller\TransaksiController::get'
// ]));

//Transaksi
$routes->add('transaksiCreate', new Route('/transaksi/create', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::create'
]));
$routes->add('transaksiStore', new Route('/transaksi/store', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::store'
]));
$routes->add('transaksiEdit', new Route('/transaksi/{idTransaksi}/edit', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::edit'
]));
$routes->add('transaksiUpdate', new Route('/transaksi/{idTransaksi}/update', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::update'
]));
$routes->add('transaksiDetail', new Route('/transaksi/{idTransaksi}/detail', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::detail'
]));
$routes->add('transaksiReceipt', new Route('/transaksi/{idTransaksi}/print-receipt', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::print_receipt'
]));
$routes->add('transaksiRetur', new Route('/transaksi/{idTransaksi}/retur', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::retur'
]));
$routes->add('transaksiReturStore', new Route('/transaksi/{idTransaksi}/retur-store', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::retur_store'
]));
$routes->add('transaksiGet', new Route('/transaksi/{idTransaksi}/get', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::get'
]));
$routes->add('transaksiReportPdf', new Route('/transaksi/report-pdf', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::report_pdf'
]));
$routes->add('transaksi', new Route('/transaksi/{jenis}', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::index'
]));

return $routes;