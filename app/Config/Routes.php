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
$routes->get('/registrarse', 'CtrlUsuarios::registrarse');
$routes->get('/login', 'CtrlUsuarios::login');

/*
 * --------------------------------------------------------------------
 * Definición de rutas para los usuarios
 * --------------------------------------------------------------------
 */
$routes->post('registrar_usuario', 'CtrlUsuarios::insertar_usuario');
$routes->post('loguear_usuario', 'CtrlUsuarios::controlar_logueo');
$routes->get('cerrar_sesion', 'CtrlUsuarios::logout');
$routes->get('bienvenida_registro', 'CtrlUsuarios::mostrar_bienvenida');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
