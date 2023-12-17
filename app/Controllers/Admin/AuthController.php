<?php

namespace App\Controllers\Admin;


use App\Models\UserModel;
use Mobicms\Captcha\Code;
use Mobicms\Captcha\Image;
use Myth\Auth\Entities\User;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    protected $auth;

    /**
     * @var AuthConfig
     */
    protected $config;

    /**
     * @var Session
     */
    protected $session;

    public function __construct()
    {
        $this->session = service('session');

        $this->config = config('Auth');
        $this->auth   = service('authentication');
    }

    public function login()
    {
        $code = (string) new Code;
        $_SESSION['code'] = $code;

        $codecap = new Image($code);

        if ($this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);
                return redirect()->to($redirectURL);
        }
            $_SESSION['redirect_url'] = session('redirect_url') ?? url_to('admin.dashboard') ?? site_url('/');
                return view('Auth/login', ['config' => $this->config, 'codecap' => $codecap]);
    }

    public function attemptLogin()
    {

        $result = $this->request->getPost('capcha');
        $session = $_SESSION['code'];

        if ($result !== null && $session !== null) {
            if (strtolower($result) == strtolower($session)) {         
                $rules = [
                    'login'    => 'required',
                    'password' => 'required',
                ];
                if ($this->config->validFields === ['email']) {
                    $rules['login'] .= '|valid_email';
                }

                if (! $this->validate($rules)) {
                    return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
                }

                $login    = $this->request->getPost('login');
                $password = $this->request->getPost('password');
                $remember = (bool) $this->request->getPost('remember');

                // Determine credential type
                $type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

                // Try to log them in...
                if (! $this->auth->attempt([$type => $login, 'password' => $password], $remember)) {
                    return redirect()->back()->withInput()->with('error', $this->auth->error() ?? lang('Auth.badAttempt'));
                }

                // Is the user being forced to reset their password?
                if ($this->auth->user()->force_pass_reset === true) {
                    return redirect()->to(route_to('reset-password') . '?token=' . $this->auth->user()->reset_hash)->withCookies();
                }

                $redirectURL = session('redirect_url') ?? url_to('login');
                unset($_SESSION['redirect_url']);
                    return redirect()->to($redirectURL)->withCookies()->with('message', lang('Auth.loginSuccess'));
            } else {
                return redirect()->to(url_to('login'));
            }
        }
    }

    /**
     * Log the user out.
     */
    public function logout()
    {
        if ($this->auth->check()) {
            $this->auth->logout();
        }
            return redirect()->to(site_url('/'));
    }

    /**
     * Displays the user registration page.
     */
    public function register()
    {
        if ($this->auth->check()) {
            return redirect()->back();
        }

        if (! $this->config->allowRegistration) {
            return redirect()->back()->withInput()->with('error', 'Registrasi Tidak Di Izinkan');
        }
            return view('Auth/register', ['config' => $this->config]);
    }

    /**
     * Attempt to register a new user.
     */
    public function attemptRegister()
    {
        // Check if registration is allowed
        if (! $this->config->allowRegistration) {
            return redirect()->back()->withInput()->with('error', 'Registration is Not allowed');
        }

        $users = model(UserModel::class);

        // Validate basics first since some password rules rely on these fields
        $rules = config('Validation')->registrationRules ?? [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validate passwords since they can only be validated properly here
        $rules = [
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_merge(['password'], $this->config->validFields, $this->config->personalFields);
        $user              = new User($this->request->getPost($allowedPostFields));

        $this->config->requireActivation === null ? $user->activate() : $user->generateActivateHash();

        // Ensure default group gets assigned if set
        if (! empty($this->config->defaultUserGroup)) {
            $users = $users->withGroup($this->config->defaultUserGroup);
        }

        if (! $users->save($user)) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        if ($this->config->requireActivation !== null) {
            $activator = service('activator');
            $sent      = $activator->send($user);

            if (! $sent) {
                return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
            }
                // Success!
                return redirect()->route('login')->with('message', lang('Auth.activationSuccess'));
        }

            // Success!
            return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));
    }
}
