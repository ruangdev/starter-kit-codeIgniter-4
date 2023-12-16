<?php

namespace App\Controllers\Auth;

use Myth\Auth\Controllers\AuthController;

class LoginController extends AuthController
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
        if ($this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);
            return redirect()->to($redirectURL);
        }
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');
            return view('Auth/login', ['config' => $this->config]);
    }
}
