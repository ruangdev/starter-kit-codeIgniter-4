<?php

namespace App\Validation\Permission;

use CodeIgniter\Validation\Rules;

class StoreValidation extends Rules
{
    public static function rules(): array
    {
        return [
            'module'    => 'required',
            'permissionName'              => 'required|alpha',
            'permissionDescription'       => 'required'
        ];
    }

    public static function messages(): array
    {
        return [
            'module' =>[
                'required'  => 'Module wajib diisi.'
            ],
            'permissionName' => [
                'required'  => 'Nama Permission wajib diisi.',
                'alpha'     => 'Nama Permission hanya boleh berisi huruf kecil.'
            ],
            'permissionDescription' => [
                'required'  => 'Deskripsi Permission wajib diisi.'
            ]
        ];
    }
}
