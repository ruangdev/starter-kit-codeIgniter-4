<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Myth\Auth\Config\Auth as AuthConfig;
use App\Authentication\LocalAuthenticator;

class Auth extends AuthConfig
{

    /**
     * --------------------------------------------------------------------
     * Require Confirmation Registration via Email
     * --------------------------------------------------------------------
     *
     * When enabled, every registered user will receive an email message
     * with an activation link to confirm the account.
     *
     * @var string|null Name of the ActivatorInterface class
     */
    public $requireActivation = null;

    /**
     * --------------------------------------------------------------------
     * Layout for the views to extend
     * --------------------------------------------------------------------
     *
     * @var string
     */
    public $viewLayout = 'app\View\Auth';

    /**
     * --------------------------------------------------------------------
     * Views used by Auth Controllers
     * --------------------------------------------------------------------
     *
     * @var array
     */
    public $views = [
        'login'           => 'app\View\Auth\login',
        'register'        => 'app\View\Auth\register',
    ];

    /**
     * --------------------------------------------------------------------
     * Libraries
     * --------------------------------------------------------------------
     *
     * @var array
     */
    public $authenticationLibs = [
        'local' => LocalAuthenticator::class,
    ];

}