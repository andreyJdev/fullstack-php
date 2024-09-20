<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('messages/(:num)', 'MessageController::getActiveUserMessages/$1');
$routes->post('messages/add', 'MessageController::addMessage');