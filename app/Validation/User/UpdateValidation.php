<?php

namespace App\Validation\User;

use CodeIgniter\Validation\Rules;

class UpdateValidation extends Rules
{
    public static function rules($id): array
    {
        return [
            'fullName'     => 'required|max_length[50]',
            'name'         => "required|max_length[50]|is_unique[users.username,id,$id]",
            'email'        => "required|max_length[50]|valid_email|is_unique[users.email,id,$id]",
            'telegramid'   => 'required|min_length[5]|max_length[20]',
            'Numberphone'  => 'required|regex_match[/^08\d{9,15}$/]'
        ];
    }

    public static function messages($id): array
    {
        return [
            'fullName'     => [
                'required'    => 'Kolom Full Name harus diisi.',
                'max_length'  => 'Panjang karakter Full Name maksimal 50 karakter.'
            ],
            'name'         => [
                'required'    => 'Kolom Name harus diisi.',
                'max_length'  => 'Panjang karakter Name maksimal 50 karakter.',
                'is_unique'   => 'Name sudah digunakan, silakan pilih nama lain.'
            ],
            'email'        => [
                'required'    => 'Kolom Email harus diisi.',
                'valid_email' => 'Format Email tidak valid.',
                'is_unique'   => 'Email sudah digunakan, silakan gunakan email lain.'
            ],
            'telegramid'   => [
                'required'    => 'Kolom Telegram ID harus diisi.',
                'min_length'  => 'Panjang karakter Telegram ID minimal 5 karakter.',
                'max_length'  => 'Panjang karakter Telegram ID maksimal 20 karakter.'
            ],
            'Numberphone'  => [
                'required'    => 'Kolom Number Phone harus diisi.',
                'regex_match' => 'Format Number Phone tidak valid.'
            ]
        ];
    }
}
