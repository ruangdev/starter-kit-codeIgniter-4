<?php

namespace App\Controllers\API;

use Config\Database;
use CodeIgniter\Controller;
use Myth\Auth\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends Controller
{
    use ResponseTrait;

    protected $modelName    = 'Myth\Auth\Models\UserModel';
    protected $format       = 'json';
    protected $db;

    public function __construct()
    {
        $this->user   = new UserModel();
        $this->auth   = service('authentication');
    }

    public function login()
    {        
        $username   = $this->request->getVar('username');
        $password   = $this->request->getVar('password');
        $user       = $this->user->where('username', $username)->first();

            if (!$this->auth->attempt(['username' => $username, 'password' => $password])) {
                return $this->failUnauthorized('Invalid login credentials');
            } elseif(!$user) {
                return $this->failUnauthorized('Invalid login credentials');
            } else {
                /**
                 * Proses JWT
                 */
                return $this->response->setJSON([
                    'data' => "Oke",
                ]);
            }
    }
}
