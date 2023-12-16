<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;
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

    public function logout()
    {
        if ($this->auth->check()) {
            $this->auth->logout();
        }

        return redirect()->to(site_url('/'));
    }


    public function register()
    {
        if ($this->auth->check()) {
            return redirect()->back();
        }

        if (! $this->config->allowRegistration) {
            return redirect()->back()->withInput()->with('error', lang('Auth.registerDisabled'));
        }

        return view('Auth/register', ['config' => $this->config]);
    }

    public function forgotPassword()
    {
        if ($this->config->activeResetter === null) {
            return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
        }

        return $this->_render($this->config->views['forgot'], ['config' => $this->config]);
    }

    public function attemptForgot()
    {
        if ($this->config->activeResetter === null) {
            return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
        }

        $rules = [
            'email' => [
                'label' => lang('Auth.emailAddress'),
                'rules' => 'required|valid_email',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $users = model(UserModel::class);

        $user = $users->where('email', $this->request->getPost('email'))->first();

        if (null === $user) {
            return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
        }

        $user->generateResetHash();
        $users->save($user);

        $resetter = service('resetter');
        $sent     = $resetter->send($user);

        if (! $sent) {
            return redirect()->back()->withInput()->with('error', $resetter->error() ?? lang('Auth.unknownError'));
        }

        return redirect()->route('reset-password')->with('message', lang('Auth.forgotEmailSent'));
    }

    public function resetPassword()
    {
        if ($this->config->activeResetter === null) {
            return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
        }

        $token = $this->request->getGet('token');

        return $this->_render($this->config->views['reset'], [
            'config' => $this->config,
            'token'  => $token,
        ]);
    }

    public function attemptReset()
    {
        if ($this->config->activeResetter === null) {
            return redirect()->route('login')->with('error', lang('Auth.forgotDisabled'));
        }

        $users = model(UserModel::class);
        $users->logResetAttempt(
            $this->request->getPost('email'),
            $this->request->getPost('token'),
            $this->request->getIPAddress(),
            (string) $this->request->getUserAgent()
        );

        $rules = [
            'token'        => 'required',
            'email'        => 'required|valid_email',
            'password'     => 'required|strong_password',
            'pass_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $users->where('email', $this->request->getPost('email'))
            ->where('reset_hash', $this->request->getPost('token'))
            ->first();

        if (null === $user) {
            return redirect()->back()->with('error', lang('Auth.forgotNoUser'));
        }

        if (! empty($user->reset_expires) && time() > $user->reset_expires->getTimestamp()) {
            return redirect()->back()->withInput()->with('error', lang('Auth.resetTokenExpired'));
        }

        $user->password         = $this->request->getPost('password');
        $user->reset_hash       = null;
        $user->reset_at         = date('Y-m-d H:i:s');
        $user->reset_expires    = null;
        $user->force_pass_reset = false;
        $users->save($user);
            return redirect()->route('login')->with('message', lang('Auth.resetSuccess'));
    }

    /**
     * Activate account.
     *
     * @return mixed
     */
    public function activateAccount()
    {
        $users = model(UserModel::class);

        $users->logActivationAttempt(
            $this->request->getGet('token'),
            $this->request->getIPAddress(),
            (string) $this->request->getUserAgent()
        );

        $throttler = service('throttler');

        if ($throttler->check(md5($this->request->getIPAddress()), 2, MINUTE) === false) {
            return service('response')->setStatusCode(429)->setBody(lang('Auth.tooManyRequests', [$throttler->getTokentime()]));
        }

        $user = $users->where('activate_hash', $this->request->getGet('token'))
            ->where('active', 0)
            ->first();

        if (null === $user) {
            return redirect()->route('login')->with('error', lang('Auth.activationNoUser'));
        }

        $user->activate();

        $users->save($user);

        return redirect()->route('login')->with('message', lang('Auth.registerSuccess'));
    }

    public function resendActivateAccount()
    {
        if ($this->config->requireActivation === null) {
            return redirect()->route('login');
        }

        $throttler = service('throttler');

        if ($throttler->check(md5($this->request->getIPAddress()), 2, MINUTE) === false) {
            return service('response')->setStatusCode(429)->setBody(lang('Auth.tooManyRequests', [$throttler->getTokentime()]));
        }

        $login = urldecode($this->request->getGet('login'));
        $type  = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $users = model(UserModel::class);

        $user = $users->where($type, $login)
            ->where('active', 0)
            ->first();

        if (null === $user) {
            return redirect()->route('login')->with('error', lang('Auth.activationNoUser'));
        }

        $activator = service('activator');
        $sent      = $activator->send($user);

        if (! $sent) {
            return redirect()->back()->withInput()->with('error', $activator->error() ?? lang('Auth.unknownError'));
        }
            return redirect()->route('login')->with('message', lang('Auth.activationSuccess'));
    }

    protected function _render(string $view, array $data = [])
    {
        return view($view, $data);
    }
}
