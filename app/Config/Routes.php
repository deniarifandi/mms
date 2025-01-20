<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index',['filter' => 'auth']);
$routes->get('/login','Home::showLogin');
$routes->post('/checkLogin','Home::checkLogin');
$routes->get('/register','Home::register');
$routes->get('/logout','Home::logout');


$routes->group('/students',['filter' => 'auth'],static function ($routes){
	$routes->get('/','StudentsController::index');
	$routes->get('show/(:num)','StudentsController::show/$1');
	$routes->get('create','StudentsController::create');
	$routes->post('store','StudentsController::store');
	$routes->get('edit/(:num)','StudentsController::edit/$1');
	$routes->post('update/(:num)','StudentsController::update/$1');
	$routes->delete('delete/(:num)','StudentsController::delete/$1');
});

$routes->group('/classes', ['filter' => 'auth'],static function ($routes){
	$routes->get('/','ClassesController::index');
	$routes->get('show/(:num)','ClassesController::show/$1');
	$routes->get('create','ClassesController::create');
	$routes->post('store','ClassesController::store');
	$routes->get('edit/(:num)','ClassesController::edit/$1');
	$routes->post('update/(:num)','ClassesController::update/$1');
	$routes->delete('delete/(:num)','ClassesController::delete/$1');
});

$routes->group('/subjects', ['filter' => 'auth'],static function ($routes){
	$routes->get('/','SubjectsController::index');
	$routes->get('show/(:num)','SubjectsController::show/$1');
	$routes->get('create','SubjectsController::create');
	$routes->post('store','SubjectsController::store');
	$routes->get('edit/(:num)','SubjectsController::edit/$1');
	$routes->post('update/(:num)','SubjectsController::update/$1');
	$routes->delete('delete/(:num)','SubjectsController::delete/$1');

	$routes->get('view/(:any)','SubjectsController::view/$1');
});

$routes->group('/objectives', ['filter' => 'auth'],static function ($routes){
	$routes->get('/','ObjectivesController::index');
	$routes->get('show/(:num)','ObjectivesController::show/$1');
	$routes->get('create','ObjectivesController::create');
	$routes->post('store','ObjectivesController::store');
	$routes->get('edit/(:num)','ObjectivesController::edit/$1');
	$routes->post('update/(:num)','ObjectivesController::update/$1');
	$routes->delete('delete/(:num)','ObjectivesController::delete/$1');
});

$routes->group('/teachers', ['filter' => 'auth'],static function ($routes){
	$routes->get('/','TeachersController::index');
	$routes->get('show/(:num)','TeachersController::show/$1');
	$routes->get('create','TeachersController::create');
	$routes->post('store','TeachersController::store');
	$routes->get('edit/(:num)','TeachersController::edit/$1');
	$routes->post('update/(:num)','TeachersController::update/$1');
	$routes->delete('delete/(:num)','TeachersController::delete/$1');
});

$routes->group('/lesson-plans', ['filter' => 'auth'],static function ($routes){
	$routes->get('/','LessonPlansController::index');
	$routes->get('show/(:num)','LessonPlansController::show/$1');
	$routes->get('create','LessonPlansController::create');
	$routes->post('store','LessonPlansController::store');
	$routes->get('edit/(:num)','LessonPlansController::edit/$1');
	$routes->post('update/(:num)','LessonPlansController::update/$1');
	$routes->delete('delete/(:num)','LessonPlansController::delete/$1');

	$routes->get('view/(:any)/(:any)','LessonPlansController::view/$1/$2');
});

$routes->group('/pedagogys', ['filter' => 'auth'],static function ($routes){
	$routes->get('/','PedagogysController::index');
	$routes->get('show/(:num)','PedagogysController::show/$1');
	$routes->get('create','PedagogysController::create');
	$routes->post('store','PedagogysController::store');
	$routes->get('edit/(:num)','PedagogysController::edit/$1');
	$routes->post('update/(:num)','PedagogysController::update/$1');
	$routes->delete('delete/(:num)','PedagogysController::delete/$1');

	$routes->get('view/(:any)','PedagogysController::view/$1');
});

$routes->group('/microcredentials', ['filter' => 'auth'],static function ($routes){
	$routes->get('/','MicrocredentialsController::index');
	$routes->get('show/(:num)','MicrocredentialsController::show/$1');
	$routes->get('create','MicrocredentialsController::create');
	$routes->post('store','MicrocredentialsController::store');
	$routes->get('edit/(:num)','MicrocredentialsController::edit/$1');
	$routes->post('update/(:num)','MicrocredentialsController::update/$1');
	$routes->delete('delete/(:num)','MicrocredentialsController::delete/$1');

	$routes->get('view/(:any)','MicrocredentialsController::view/$1');
});

$routes->group('/cases', ['filter' => 'auth'],static function ($routes){
	$routes->get('/','CasesController::index');
	$routes->get('show/(:num)','CasesController::show/$1');
	$routes->get('create','CasesController::create');
	$routes->post('store','CasesController::store');
	$routes->get('edit/(:num)','CasesController::edit/$1');
	$routes->post('update/(:num)','CasesController::update/$1');
	$routes->delete('delete/(:num)','CasesController::delete/$1');
});

$routes->group('/presentations', ['filter' => 'auth'],static function ($routes){
	$routes->get('/','PresentationsController::index');
	$routes->get('show/(:num)','PresentationsController::show/$1');
	$routes->get('create','PresentationsController::create');
	$routes->post('store','PresentationsController::store');
	$routes->get('edit/(:num)','PresentationsController::edit/$1');
	$routes->post('update/(:num)','PresentationsController::update/$1');
	$routes->delete('delete/(:num)','PresentationsController::delete/$1');
});