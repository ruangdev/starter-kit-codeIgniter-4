<?php

use CodeIgniter\Router\RouteCollection;
use Myth\Auth\Config\Auth as AuthConfig;

/**
 * @var RouteCollection $routes
 */
$routes->group('cms/v1',function($routes) {
    /**
     * Route Login & Logout
     */
    $routes->get('login', 'Admin\AuthController::login', ['as' => 'login']);
    $routes->post('login', 'Admin\AuthController::attemptLogin');
    $routes->get('logout', 'Admin\AuthController::logout');

    /**
     * Route Register
     */
    $routes->get('register', 'Admin\AuthController::register', ['as' => 'register']);
    $routes->post('register', 'Admin\AuthController::attemptRegister');
});

$routes->get('/', 'Home::index', ['filter' => 'login']);
$routes->group('/', ['filter' => 'login'], function($routes) {
    $routes->get('/home', 'Home::index');
});