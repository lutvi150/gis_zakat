<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('logout', 'Home::logout');
$routes->get('login', 'Home::login');
$routes->post('login', 'Home::login_auth');
$routes->group('admin', function (RouteCollection $routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('penyaluran', 'Admin::penyaluran');
});
