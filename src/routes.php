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

$routes->add('hello', new Route('/hellos/get/{id}', [
    '_controller' => 'App\Calendar\Controller\LeapYearController::testing',
]));


// CRUD Bank

$routes->add('bank', new Route('/bank', [
    '_controller' => 'App\Bank\Controller\BankController::index',
]));

$routes->add('bankEdit', new Route('/bank/edit/{id}', [
    '_controller' => 'App\Bank\Controller\BankController::edit'
]));
//

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

$routes->add('produksedit', new Route('/produk/edit/{id}', [
    '_controller' => 'App\Produk\Controller\ProdukController::ReadOne',
]));

$routes->add('produkupdate', new Route('/produk/edit/{id}/update', [
    '_controller' => 'App\Produk\Controller\ProdukController::update',
]));

$routes->add('produkshapus', new Route('/produk/delete/{id}', [
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

$routes->add('transaksiCreate', new Route('transaksi/create', [
    '_controller' => 'App\Transaksi\Controller\TransaksiController::create'
]));

return $routes;