<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/school_dashboard','Home::school_dashboard');

//subject
$routes->get('/subjects', 'Home::subject');

//objective
$routes->get('/objective','Home::objective');

//grades
$routes->get('/grades','Home::grades');

