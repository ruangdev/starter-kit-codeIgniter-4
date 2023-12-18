<?php

namespace App\Controllers\Admin;

use App\Models\Users;
use Myth\Auth\Password;
use App\Models\UserProfile;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        // $result = Users::join('user_profile', 'users.id', '=', 'user_profile.user_id')
        // ->select('users.id', 'users.email', 'users.username', 'user_profile.fullName', 'user_profile.numberPhone', 'user_profile.TeleID')
        // ->get();
		// return $this->response->setJSON([
		// 	'data'   => $result
		// ]);
        return view('Admin/User/index');
    }

    public function store()
    {
        $result = Users::create([
            'username'       => 'budikuncoro',
            'email'          => 'budi@gmail.com',
            'password_hash'  => Password::hash('password123'),
            'active'         => true
        ]);
            UserProfile::create([
                'user_id'           => $result->id,
                'fullName'          => 'Budi Kuncoro',
                'imageName'         => 'imageBudi',
                'pathImage'         => 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y',
                'numberPhone'       => '09080800908',
                'TeleID'            => '908089799'
            ]);
    }
}
