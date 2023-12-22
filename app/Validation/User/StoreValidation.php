<?php

namespace App\Validation\User;

use CodeIgniter\Validation\Rules;

class StoreValidation extends Rules
{
    public static function rules(): array
    {
        return [
            'fullName'    => 'required|max_length[50]',
            'name'        => 'required|min_length[5]|max_length[50]',
            'telegramid'  => 'required|min_length[5]|max_length[20]',
            'Numberphone' => 'required|regex_match[/^08[0-9]{8,15}$/]',
            'password'    => 'required|min_length[6]',
        ];
    }

    public static function messages(): array
    {
        return [
            'fullName' => [
                'required'    => 'Nama lengkap harus diisi.',
                'max_length'  => 'Panjang karakter nama lengkap maksimal 50.'
            ],
            'name' => [
                'required'    => 'Username harus diisi.',
                'min_length'  => 'Panjang karakter Username minimal 5.',
                'max_length'  => 'Panjang karakter Username maksimal 50.'
            ],
            'telegramid' => [
                'required'    => 'Telegram ID harus diisi.',
                'min_length'  => 'Panjang karakter Telegram ID minimal 5.',
                'max_length'  => 'Panjang karakter Telegram ID maksimal 20.'
            ],
            'Numberphone' => [
                'required'    => 'Nomor Telepon harus diisi.',
                'regex_match' => 'Harus diawali dengan 08 dan panjang minimal 10 dan maksimal 15 karakter.'
            ],
            'password' => [
                'required'    => 'Password harus diisi.',
                'min_length'  => 'Panjang karakter password minimal 6.'
            ],
        ];
    }
}
