<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/getStudentsData', 'Home::getStudentsData');
$routes->get('/setStudentsData', 'Home::setStudentsData');
$routes->get('/updateStudentData', 'Home::updateStudentData');