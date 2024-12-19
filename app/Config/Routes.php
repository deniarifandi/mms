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
	$routes->delete('delete/(:num )','StudentsController::delete/$1');
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
	$routes->get('/','SubjectsController::index');
	$routes->get('show/(:num)','SubjectsController::show/$1');
	$routes->get('create','SubjectsController::create');
	$routes->post('store','SubjectsController::store');
	$routes->get('edit/(:num)','SubjectsController::edit/$1');
	$routes->post('update/(:num)','SubjectsController::update/$1');
	$routes->delete('delete/(:num)','SubjectsController::delete/$1');
});

$routes->group('/objectives',static function ($routes){
	$routes->get('/','ObjectivesController::index');
	$routes->get('show/(:num)','ObjectivesController::show/$1');
	$routes->get('create','ObjectivesController::create');
	$routes->post('store','ObjectivesController::store');
	$routes->get('edit/(:num)','ObjectivesController::edit/$1');
	$routes->post('update/(:num)','ObjectivesController::update/$1');
	$routes->delete('delete/(:num)','ObjectivesController::delete/$1');
});

$routes->group('/teachers',static function ($routes){
	$routes->get('/','TeachersController::index');
	$routes->get('show/(:num)','TeachersController::show/$1');
	$routes->get('create','TeachersController::create');
	$routes->post('store','TeachersController::store');
	$routes->get('edit/(:num)','TeachersController::edit/$1');
	$routes->post('update/(:num)','TeachersController::update/$1');
	$routes->delete('delete/(:num)','TeachersController::delete/$1');
});