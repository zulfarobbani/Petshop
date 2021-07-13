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

$routes->add('welcome', new Route('/', [
    '_controller' => function(Request $request) {
        global $app;

        return $app->render_template('welcome');
    }
]));


//Login
$routes->add('login', new Route('/login', [
    '_controller' => 'App\Login\Controller\LoginController::index',
]));
$routes->add('loginProses', new Route('/login/proses', [
    '_controller' => 'App\Login\Controller\LoginController::login_proses',
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

//Transaksi
$routes->add('transaksi', new Route('/transaksi', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::index'
]));
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

return $routes;