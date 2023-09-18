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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Definición de rutas
 * --------------------------------------------------------------------
 */
$routes->get('/', 'Home::index');
$routes->get('/inicio', 'Home::index');
$routes->get('/quienes_somos', 'Home::quienes_somos');
$routes->get('/acerca_de', 'Home::acerca_de');
$routes->get('/registrarse', 'CtrlUsuarios::registrarse',['filter'=>'auth']);
$routes->get('/login', 'CtrlLogin::login',['filter'=>'auth']);

/*
 * --------------------------------------------------------------------
 * Definición de rutas para los usuarios
 * --------------------------------------------------------------------
 */
$routes->post('registrar_usuario', 'CtrlUsuarios::insertar_usuario');
$routes->post('loguear_usuario', 'CtrlLogin::controlar_logueo');
/*Las versiones get de registrar_usuario y loguear_usuario sirven para evitar errores de páginas no
encontradas.*/
$routes->get('registrar_usuario', 'CtrlUsuarios::registrarse');
$routes->get('cerrar_sesion', 'CtrlLogin::logout');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
