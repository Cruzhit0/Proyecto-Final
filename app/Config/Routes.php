<?php

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/testdb', 'TestDb::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/autenticar', 'loginController::autenticar');
$routes->get('/logout', 'Login::logout');

// Muestra formulario de login
$routes->get('login', 'LoginController::index');

// Procesa el login
$routes->post('login/autenticar', 'LoginController::autenticar');

// Cierra sesión
$routes->get('logout', 'LoginController::logout'); // ← crea este método si lo necesitas


// Panel de administrador
$routes->get('panel/admin', 'Panel::admin');

$routes->get('panel/logout', 'Panel::logout');


// Habitaciones CRUD
$routes->get('panel/habitaciones', 'Panel::habitaciones');
$routes->get('panel/habitaciones/nueva', 'Panel::nuevaHabitacion');
$routes->post('panel/habitaciones/guardar', 'Panel::guardarHabitacion');
$routes->get('panel/habitaciones/editar/(:num)', 'Panel::editarHabitacion/$1');
$routes->post('panel/habitaciones/actualizar/(:num)', 'Panel::actualizarHabitacion/$1');
$routes->get('panel/habitaciones/eliminar/(:num)', 'Panel::eliminarHabitacion/$1');

// En app/Config/Routes.php
$routes->get('logout', 'Auth::logout');

// Rutas para Servicios del Hotel
$routes->get('servicios', 'ServicioController::index');
$routes->get('servicios/form/(:num)', 'ServicioController::form/$1');
$routes->get('servicios/form', 'ServicioController::form');
$routes->post('servicios/guardar', 'ServicioController::guardar');
$routes->get('servicios/eliminar/(:num)', 'ServicioController::eliminar/$1');

// Rutas para Usuarios

$routes->get('usuarios', 'UsuarioController::index');
$routes->get('usuarios/form/(:num)', 'UsuarioController::form/$1');
$routes->get('usuarios/form', 'UsuarioController::form');
$routes->post('usuarios/guardar', 'UsuarioController::guardar');
$routes->get('usuarios/eliminar/(:num)', 'UsuarioController::eliminar/$1');

// Rutas para Reservas
$routes->get('reservas', 'ReservaController::index');
$routes->get('reservas/form', 'ReservaController::form');
$routes->post('reservas/cargarHabitaciones', 'ReservaController::cargarHabitaciones');
$routes->post('reservas/guardar', 'ReservaController::guardar');
$routes->get('reservas/confirmar/(:num)', 'ReservaController::confirmar/$1');
$routes->post('reservas/procesarPago/(:num)', 'ReservaController::procesarPago/$1');

$routes->get('reservas/detalle/(:num)', 'ReservaController::detalle/$1');

// Check-in / Listado Diario
$routes->get('checkin', 'CheckinController::index');
$routes->get('checkin/buscarReserva/(:num)', 'CheckinController::buscarReserva/$1');
$routes->post('checkin/registrar', 'CheckinController::registrar');
$routes->get('checkin/listado', 'CheckinController::listado');

$routes->get('servicios-extras', 'ServicioExtraController::index');
$routes->post('servicios-extras/registrar', 'ServicioExtraController::registrar');

$routes->get('servicios-extras/listado-por-habitacion', 'ServicioExtraController::listadoPorHabitacion');

// Check-out
$routes->get('checkout', 'CheckoutController::index');
$routes->get('checkout/detalle/(:num)', 'CheckoutController::detalle/$1');
$routes->post('checkout/procesar/(:num)', 'CheckoutController::procesar/$1');
$routes->get('checkout/recibo/(:num)', 'CheckoutController::recibo/$1');


// Tipos de Habitación - Rutas bajo /panel (controlador en raíz de Controllers)
$routes->get('panel/habitacionesTipo', 'HabitacionesTipoController::index');
$routes->get('panel/habitacionesTipo/crear', 'HabitacionesTipoController::crear');
$routes->post('panel/habitacionesTipo/store', 'HabitacionesTipoController::store');
$routes->get('panel/habitacionesTipo/editar/(:num)', 'HabitacionesTipoController::editar/$1');
$routes->post('panel/habitacionesTipo/update/(:num)', 'HabitacionesTipoController::update/$1');
$routes->get('panel/habitacionesTipo/eliminar/(:num)', 'HabitacionesTipoController::eliminar/$1');
$routes->get('panel/habitacionesTipo/activar/(:num)', 'HabitacionesTipoController::activar/$1');
$routes->get('panel/habitacionesTipo/reporte', 'HabitacionesTipoController::reporte');