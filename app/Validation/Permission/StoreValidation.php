<?php

namespace App\Validation\Permission;

use CodeIgniter\Validation\Rules;

class StoreValidation extends Rules
{
    public static function rules(): array
    {
        return [
            'module'                      => 'required',
            'permissionName'              => 'required|regex_match[/^[a-z\.]+$/]|is_unique[auth_permissions.name]',
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
                'required'      => 'Nama Permission wajib diisi.',
                'regex_match'   => 'Nama Permission hanya boleh diisi dengan huruf kecil dan titik saja.',
                'is_unique'     => 'Nama Permission harus berisi nilai unik'
            ],
            'permissionDescription' => [
                'required'  => 'Deskripsi Permission wajib diisi.'
            ]
        ];
    }
}
