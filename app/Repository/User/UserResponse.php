<?php

namespace App\Repository\User;

use Config\Database;
use App\Helpers\UUID;
use App\Models\Users;
use Myth\Auth\Password;
use App\Models\UserProfile;
use Illuminate\Support\Str;
use App\Repository\User\UserDesign;

class UserResponse implements UserDesign {

    public function __construct()
    {
        $this->db        = Database::connect();
        $this->users     = new Users;
        $this->profile   = new UserProfile();
        $this->uuid      = UUID::create();
    }

    public function datatable()
    {
        return $this->db->table('user_profile')
                        ->join('users', 'users.id = user_profile.user_id')
                        ->select('users.id, users.email, users.username, user_profile.fullName, user_profile.numberPhone, user_profile.TeleID');
    }
    public function create($param)
    {
        $result = $this->users->create([
            'username'       => $param['name'],
            'email'          => $param['email'],
            'password_hash'  => Password::hash($param['password']),
            'active'         => true
        ]);
            $this->profile->create([
                'id'                => $this->uuid,
                'user_id'           => $result->id,
                'fullName'          => $param['fullName'],
                'imageName'         => $this->uuid,
                'pathImage'         => 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y',
                'numberPhone'       => $param['Numberphone'],
                'TeleID'            => $param['telegramid']
            ]);
    }

    public function find($id)
    {
        return $this->db->table('user_profile')
                        ->join('users', 'users.id = user_profile.user_id')
                        ->select('users.id, users.email, users.username, user_profile.fullName, user_profile.numberPhone, user_profile.TeleID')
                        ->where('users.id',$id)
                        ->get()->getRow();
    }

    public function update($param, $id)
    {
        $data = [
            'username'       => $param['name'],
            'email'          => $param['email'],
            'active'         => true
        ];

        if ($param['password']) {
            $data['password_hash'] = Password::hash($param['password']);
        }
            $result = $this->users->whereId($id)
                                  ->update($data);
            $this->profile->whereUserId($id)
                        ->update([
                            'fullName'      => $param['fullName'],
                            'numberPhone'   => $param['Numberphone'],
                            'TeleID'        => $param['telegramid']
                        ]);
    }
}