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
    $routes->post('store-role','Authorization\RoleController::store',['as' => 'admin.role.store']);
    $routes->get('edit-role/(:segment)','Authorization\RoleController::edit/$1',['as' => 'admin.role.edit']);
    $routes->put('update-role/(:segment)','Authorization\RoleController::update/$1',['as' => 'admin.role.update']);
    $routes->delete('delete-role/(:segment)','Authorization\RoleController::delete/$1',['as' => 'admin.role.delete']);

    /**
     * Route Permission
     */
    $routes->get('list-permission','Authorization\PermissionController::index',['as' => 'admin.permission.list']);
    $routes->get('create-permission','Authorization\PermissionController::create',['as' => 'admin.permission.create']);
    $routes->post('store-permission','Authorization\PermissionController::store',['as' => 'admin.permission.store']);
    $routes->get('edit-permission/(:segment)','Authorization\PermissionController::edit/$1',['as' => 'admin.permission.edit']);
    $routes->put('update-permission/(:segment)','Authorization\PermissionController::update/$1',['as' => 'admin.permission.update']);
    $routes->delete('delete-permission/(:segment)','Authorization\PermissionController::delete/$1',['as' => 'admin.permission.delete']);

    /**
     * Route Module
     */
    $routes->get('list-module','Authorization\ModuleController::index',['as' => 'admin.module.list']);
    $routes->get('create-module','Authorization\ModuleController::create',['as' => 'admin.module.create']);
    $routes->post('store-module','Authorization\ModuleController::store',['as' => 'admin.module.store']);
    $routes->get('edit-module/(:segment)','Authorization\ModuleController::edit/$1',['as' => 'admin.module.edit']);
    $routes->put('update-module/(:segment)','Authorization\ModuleController::update/$1',['as' => 'admin.module.update']);
    $routes->delete('delete-module/(:segment)','Authorization\ModuleController::delete/$1',['as' => 'admin.module.delete']);
});

/**
 * Route API
 */
$routes->group('/api/v1', function($routes) {
    $routes->post('login','API\AuthController::login',['as' => 'api.login']);
});