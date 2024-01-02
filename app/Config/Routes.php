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

    /**
     * Route Error Page
     */
    $routes->get('forbidden-page','Errors\Page403Controller::index',['as' => 'page.403']);

    /**
     * Route Dashboard
     */
    $routes->get('dashboard', 'Admin\DashboardController::index',['as' => 'admin.dashboard']);

    /**
     * Route User Management
     */
    $routes->get('list-admin', 'Admin\UserController::index',['as' => 'admin.user.list', 'filter' => 'permission:show.users']);
    $routes->get('create-admin','Admin\UserController::create',['as' => 'admin.user.create']);
    $routes->post('store-admin','Admin\UserController::store',['as' => 'admin.user.store']);
    $routes->get('edit-admin/(:segment)','Admin\UserController::edit/$1',['as' => 'admin.user.edit']);
    $routes->put('update-admin/(:segment)','Admin\UserController::update/$1',['as' => 'admin.user.update']);
    $routes->delete('delete-admin/(:segment)','Admin\UserController::delete/$1',['as' => 'admin.user.delete']);
    $routes->put('status-admin/(:segment)','Admin\UserController::status/$1',['as' => 'admin.user.status']);

    /**
     * Route Role
     */
    $routes->get('list-role','Authorization\RoleController::index',['as' => 'admin.role.list']);
    $routes->get('create-role','Authorization\RoleController::create',['as' => 'admin.role.create']);

    /**
     * Route Role
     */
    $routes->get('list-permission','Authorization\PermissionController::index',['as' => 'admin.permission.list']);
    $routes->get('create-permission','Authorization\PermissionController::create',['as' => 'admin.permission.create']);
    $routes->post('store-permission','Authorization\PermissionController::store',['as' => 'admin.permission.store']);
    $routes->get('edit-permission/(:segment)','Authorization\PermissionController::edit/$1',['as' => 'admin.permission.edit']);
    $routes->put('update-permission/(:segment)','Authorization\PermissionController::update/$1',['as' => 'admin.permission.update']);
});