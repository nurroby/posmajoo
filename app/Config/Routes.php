<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');

$routes->group('admin', function ($routes) {
    $routes->add('/', 'Admin\Home::index');
    $routes->add('login', 'Admin\Home::login');
    $routes->add('auth', 'Admin\Home::auth');
    $routes->add('logout', 'Admin\Home::logout');
    $routes->add('category', 'Admin\Category::index');
    $routes->add('category/add', 'Admin\Category::create');
    $routes->add('product', 'Admin\Product::index');
    $routes->add('product/add', 'Admin\Product::create');
});

$routes->group('users', function ($routes) {
    $routes->add('/', 'User\Home::index');
    $routes->add('logout', 'User\Home::index');
});

$routes->group('api', function ($routes) {
    $routes->get('/', 'Api\Home::index');
    $routes->get('admin/login', 'Api\Admin::login');
    $routes->get('admin/logout', 'Api\Admin::logout');
    $routes->get('category', 'Api\Category::index');
        $routes->post('category', 'Api\Category::addCategory');
        $routes->put('category', 'Api\Category::editCategory');
        $routes->delete('category', 'Api\Category::deleteCategory');
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
