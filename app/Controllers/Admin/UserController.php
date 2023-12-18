<?php

namespace App\Controllers\Admin;

use Config\Database;
use App\Models\Users;
use Myth\Auth\Password;
use App\Models\UserProfile;
use \Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function index()
    {
        if($this->request->isAJAX()) {
            $result = $this->db->table('user_profile')
                                ->join('users', 'users.id = user_profile.user_id')
                                ->select('users.id, users.email, users.username, user_profile.fullName, user_profile.numberPhone, user_profile.TeleID');
            return DataTable::of($result)->addNumbering('no')
                                        ->add('action', function($row){
                                            return  '
                                                        <button type="button" class="btn btn-primary btn-sm") ><i class="fas fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm") ><i class="fas fa-trash-alt"></i></button>
                                                    ';
                                        })
                                        ->toJson(true);
        }
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
