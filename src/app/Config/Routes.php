<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
$routes->get('messages/(:num)', 'MessageController::getActiveUserMessages/$1');
$routes->get('messages/(:num)/(:alpha)/(:alpha)', 'MessageController::getActiveUserMessages/$1/$2/$3');
$routes->post('messages/delete/(:num)', 'MessageController::deleteMessage/$1');
$routes->post('messages/add', 'MessageController::addMessage');
$routes->get('register', 'RegisterController::index');
$routes->post('register/store', 'RegisterController::store');