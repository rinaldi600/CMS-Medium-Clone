<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(function () {
    return view('NotFound/404');
});
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('/signup', 'signup::index');
$routes->get('/forgotPassword', 'forgotPassword::index');
$routes->get('/forgotPassword/token', 'forgotPassword::token');
$routes->get('/forgotPassword/resetPassword', 'forgotPassword::resetPassword');
$routes->get('/main', 'main::index');
$routes->get('/main/add', 'main::add');
$routes->get('/main/detail', 'main::detail');
$routes->get('/main/preview/(:segment)', 'main::preview/$1');
$routes->get('/main/update', 'main::update');
$routes->get('/home', 'home::index');
$routes->get('/home/detail/(:segment)', 'home::detail/$1');
$routes->get('/home/(:any)', 'home::index');
$routes->get('/(:any)', 'Login::index');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
