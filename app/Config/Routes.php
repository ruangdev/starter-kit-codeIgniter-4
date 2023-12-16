<?php

use CodeIgniter\Router\RouteCollection;
use Myth\Auth\Config\Auth as AuthConfig;
/**
 * @var RouteCollection $routes
 */

$routes->get('/login', 'Auth\LoginController::login', ['as' => 'login']);
// $routes->post('/login', 'loginController::attemptLogin');
// $routes->get('/logout', 'loginController::logout');

$routes->get('/register', 'Auth\loginController::register', ['as' => 'register']);
// $routes->post('register', 'loginController::attemptRegister');

// $routes->get('activate-account', 'loginController::activateAccount', ['as' => 'activate-account']);
// $routes->get('resend-activate-account', 'loginController::resendActivateAccount', ['as' => 'resend-activate-account']);

// $routes->get('forgot', 'loginController::forgotPassword', ['as' => 'forgot']);
// $routes->post('forgot', 'loginController::attemptForgot');
// $routes->get('reset-password', 'loginController::resetPassword', ['as' => 'reset-password']);
// $routes->post('reset-password', 'loginController::attemptReset');

// $routes->group('', ['namespace' => 'App\Controllers'], static function ($routes) {
    // $config         = config(AuthConfig::class);
    // $reservedRoutes = $config->reservedRoutes;

    // Login/out
    // $routes->get('/login', 'Auth\loginController::login', ['as' => 'login']);
    // $routes->post('/login', 'loginController::attemptLogin');
    // $routes->get('/logout', 'loginController::logout');

    // Registration
    // $routes->get('register', 'loginController::register', ['as' => 'register']);
    // $routes->post('register', 'loginController::attemptRegister');

    // Activation
    // $routes->get('activate-account', 'loginController::activateAccount', ['as' => 'activate-account']);
    // $routes->get('resend-activate-account', 'loginController::resendActivateAccount', ['as' => 'resend-activate-account']);

    // Forgot/Resets
    // $routes->get('forgot', 'loginController::forgotPassword', ['as' => 'forgot']);
    // $routes->post('forgot', 'loginController::attemptForgot');
    // $routes->get('reset-password', 'loginController::resetPassword', ['as' => 'reset-password']);
    // $routes->post('reset-password', 'loginController::attemptReset');
// });

$routes->get('/', 'Home::index', ['filter' => 'login']);
$routes->get('/home', 'Home::index', ['filter' => 'login']);