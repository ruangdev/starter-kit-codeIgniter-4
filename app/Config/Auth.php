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
     * Allow User Registration
     * --------------------------------------------------------------------
     *
     * When enabled (default) any unregistered user may apply for a new
     * account. If you disable registration you may need to ensure your
     * controllers and views know not to offer registration.
     *
     * @var bool
     */
    public $allowRegistration = true;


     /**
     * --------------------------------------------------------------------
     * Allow Persistent Login Cookies (Remember me)
     * --------------------------------------------------------------------
     *
     * While every attempt has been made to create a very strong protection
     * with the remember me system, there are some cases (like when you
     * need extreme protection, like dealing with users financials) that
     * you might not want the extra risk associated with this cookie-based
     * solution.
     *
     * @var bool
     */
    public $allowRemembering = false;

    /**
     * --------------------------------------------------------------------
     * Remember Length
     * --------------------------------------------------------------------
     *
     * The amount of time, in seconds, that you want a login to last for.
     * Defaults to 30 days.
     *
     * @var int
     */
    public $rememberLength = 30 * DAY;

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