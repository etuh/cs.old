<?php

namespace Config;
use App\Controllers\Accounts;
use App\Controllers\Delete;
use App\Controllers\Fly;
use App\Controllers\Home;
use App\Controllers\Job;
use App\Controllers\Order;
use App\Controllers\Users;

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Users
$routes->get('/users/', [Users::class, 'users']);
$routes->get('/users/(:num?)/', [Users::class, 'users']);
$routes->get('/users/register/', [Accounts::class, 'register']);
$routes->post('/users/register/', [Accounts::class, 'register']);
$routes->get('/signup', [Accounts::class, 'signup']);
$routes->post('/signup/', [Accounts::class, 'signup']);
$routes->get('/users/delete/(:num?)', [Delete::class, 'DeleteUser']);


// Accounts
$routes->get('/login/', [Accounts::class, 'login']);
$routes->post('/login/', [Accounts::class, 'login']);
$routes->get('/logout/', [Accounts::class, 'logout']);
$routes->get('/accounts/profile', [Accounts::class, 'profile']);
$routes->post('/accounts/profile', [Accounts::class, 'profile']);

// Customers
$routes->get('/customers', [Users::class, 'customers']);

$routes->get('/emailtest/',[Accounts::class, 'mailtest']);
$routes->get('/test/',[Home::class, 'test']);



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
