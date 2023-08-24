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

/*
 * --------------------------------------------------------------------
 * Definición de rutas
 * --------------------------------------------------------------------
 */
$routes->get('/', 'Home::index');
$routes->get('/inicio', 'Home::index');
$routes->get('/quienes_somos', 'Home::quienes_somos');
$routes->get('/acerca_de', 'Home::acerca_de');
$routes->get('/registrarse', 'Home::registrarse');
$routes->get('/login', 'Home::login');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
