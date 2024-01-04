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

    /**
     * --------------------------------------------------------------------
     * Encryption Algorithm to Use
     * --------------------------------------------------------------------
     *
     * Valid values are
     * - PASSWORD_DEFAULT (default)
     * - PASSWORD_BCRYPT
     * - PASSWORD_ARGON2I  - As of PHP 7.2 only if compiled with support for it
     * - PASSWORD_ARGON2ID - As of PHP 7.3 only if compiled with support for it
     *
     * If you choose to use any ARGON algorithm, then you might want to
     * uncomment the "ARGON2i/D Algorithm" options to suit your needs
     *
     * @var int|string
     */
    public $hashAlgorithm = PASSWORD_DEFAULT;

    /**
     * --------------------------------------------------------------------
     * ARGON2i/D Algorithm options
     * --------------------------------------------------------------------
     *
     * The ARGON2I method of encryption allows you to define the "memory_cost",
     * the "time_cost" and the number of "threads", whenever a password hash is
     * created.
     *
     * This defaults to a value of 10 which is an acceptable number.
     * However, depending on the security needs of your application
     * and the power of your hardware, you might want to increase the
     * cost. This makes the hashing process takes longer.
     */

    /**
     * @var int
     */
    public $hashMemoryCost = 2048; // PASSWORD_ARGON2_DEFAULT_MEMORY_COST;

    /**
     * @var int
     */
    public $hashTimeCost = 4; // PASSWORD_ARGON2_DEFAULT_TIME_COST;

    /**
     * @var int
     */
    public $hashThreads = 4; // PASSWORD_ARGON2_DEFAULT_THREADS;

    /**
     * --------------------------------------------------------------------
     * Password Hashing Cost
     * --------------------------------------------------------------------
     *
     * The BCRYPT method of encryption allows you to define the "cost"
     * or number of iterations made, whenever a password hash is created.
     * This defaults to a value of 10 which is an acceptable number.
     * However, depending on the security needs of your application
     * and the power of your hardware, you might want to increase the
     * cost. This makes the hashing process takes longer.
     *
     * Valid range is between 4 - 31.
     *
     * @var int
     */
    public $hashCost = 10;

    /**
     * --------------------------------------------------------------------
     * Minimum Password Length
     * --------------------------------------------------------------------
     *
     * The minimum length that a password must be to be accepted.
     * Recommended minimum value by NIST = 8 characters.
     *
     * @var int
     */
    public $minimumPasswordLength = 8;

    /**
     * --------------------------------------------------------------------
     * Password Check Helpers
     * --------------------------------------------------------------------
     *
     * The PasswordValidator class runs the password through all of these
     * classes, each getting the opportunity to pass/fail the password.
     *
     * You can add custom classes as long as they adhere to the
     * Password\ValidatorInterface.
     *
     * @var string[]
     */
    public $passwordValidators = [
        'Myth\Auth\Authentication\Passwords\CompositionValidator',
        'Myth\Auth\Authentication\Passwords\NothingPersonalValidator',
        'Myth\Auth\Authentication\Passwords\DictionaryValidator',
        // 'Myth\Auth\Authentication\Passwords\PwnedValidator',
    ];
}