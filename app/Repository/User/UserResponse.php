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
            'username'       => 'budikuncoro',
            'email'          => 'budi@gmail.com',
            'password_hash'  => Password::hash('password123'),
            'active'         => true
        ]);
            $this->profile->create([
                'id'                => $this->uuid,
                'user_id'           => $result->id,
                'fullName'          => 'Budi Kuncoro',
                'imageName'         => 'imageBudi',
                'pathImage'         => 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp&f=y',
                'numberPhone'       => '09080800908',
                'TeleID'            => '908089799'
            ]);
    }
}