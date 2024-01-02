<?php

namespace App\Validation\Permission;

use CodeIgniter\Validation\Rules;

class UpdateValidation extends Rules
{
    public static function rules($id): array
    {
        return [
            'module'                      => 'required',
            'permissionName'              => "required|alpha|is_unique[auth_permissions.name,uuid,$id]",
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
