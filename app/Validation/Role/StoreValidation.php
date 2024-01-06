<?php

namespace App\Validation\Role;

use CodeIgniter\Validation\Rules;

class StoreValidation extends Rules
{
    public static function rules(): array
    {
        return [
            'role_name'         => 'required|is_unique[auth_groups.name]',
            'role_description'  => 'required',
        ];
    }

    public static function messages(): array
    {
        return [
            'role_name' => [
                'required'      => 'Nama Role wajib diisi.',
                'is_unique'     => 'Nama Role harus berisi nilai unik'
            ],
            'role_description'  => [
                'required'      => 'Nama Role Description wajib diisi.',
            ]
        ];
    }
}
