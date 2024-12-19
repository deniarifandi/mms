<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('/students',static function ($routes){
	$routes->get('/','StudentsController::index');
	$routes->get('show/(:num)','StudentsController::show/$1');
	$routes->get('create','StudentsController::create');
	$routes->post('store','StudentsController::store');
	$routes->get('edit/(:num)','StudentsController::edit/$1');
	$routes->post('update/(:num)','StudentsController::update/$1');
	$routes->delete('delete/(:num)','StudentsController::delete/$1');
});

$routes->group('/classes',static function ($routes){
	$routes->get('/','ClassesController::index');
	$routes->get('show/(:num)','ClassesController::show/$1');
	$routes->get('create','ClassesController::create');
	$routes->post('store','ClassesController::store');
	$routes->get('edit/(:num)','ClassesController::edit/$1');
	$routes->post('update/(:num)','ClassesController::update/$1');
	$routes->delete('delete/(:num)','ClassesController::delete/$1');
});

$routes->group('/subjects',static function ($routes){
	$routes->get('/','ClassesController::index');
	$routes->get('show/(:num)','ClassesController::show/$1');
	$routes->get('create','ClassesController::create');
	$routes->post('store','ClassesController::store');
	$routes->get('edit/(:num)','ClassesController::edit/$1');
	$routes->post('update/(:num)','ClassesController::update/$1');
	$routes->delete('delete/(:num)','ClassesController::delete/$1');
});