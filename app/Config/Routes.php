<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/getStudentsData', 'Home::getStudentsData');
$routes->get('/setStudentsData', 'Home::setStudentsData');
$routes->get('/updateStudentData', 'Home::updateStudentData');

$routes->group('/students',static function ($routes){
	$routes->get('/','StudentsController::index');
	$routes->get('show/(:num)','StudentsController::show/$1');
	$routes->get('create','StudentsController::create');
	$routes->post('store','StudentsController::store');
	$routes->get('edit/:num','StudentsController::edit/$1');
	$routes->post('update/:num','StudentsController::update/$1');
	$routes->delete('delete','StudentsController::delete/$1');
});