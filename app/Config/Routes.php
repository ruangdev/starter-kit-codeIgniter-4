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
    $routes->get('logout', 'Admin\AuthController::logout', ['as' => 'logout']);

    /**
     * Route Register
     */
    $routes->get('register', 'Admin\AuthController::register', ['as' => 'register']);
    $routes->post('register', 'Admin\AuthController::attemptRegister');
});

/**
 * Route Home Website
 */
$routes->get('/', 'Home::index',['as' => 'home.site', 'filter' => 'login']);

/**
 * Route Admin
 */
$routes->group('/cms/v1', ['filter' => 'login'], function($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index',['as' => 'admin.dashboard']);

    /**
     * Route User Management
     */
    $routes->get('list-admin', 'Admin\UserController::index',['as' => 'admin.user.list']);
    $routes->get('create-admin','Admin\UserController::create',['as' => 'admin.user.create']);
    $routes->post('store-admin','Admin\UserController::store',['as' => 'admin.user.store']);
    $routes->get('edit-admin/(:segment)','Admin\UserController::edit/$1',['as' => 'admin.user.edit']);
    $routes->put('update-admin/(:segment)','Admin\UserController::update/$1',['as' => 'admin.user.update']);
    $routes->delete('delete-admin/(:segment)','Admin\UserController::delete/$1',['as' => 'admin.user.delete']);
});