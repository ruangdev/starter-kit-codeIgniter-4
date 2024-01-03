<?php

namespace App\Validation\Module;

use CodeIgniter\Validation\Rules;

class UpdateValidation extends Rules
{
    public static function rules($id): array
    {
        return [
            'module_name' => "required|is_unique[auth_module.module_name,id,$id]",
        ];
    }

    public static function messages(): array
    {
        return [
            'module_name' => [
                'required'      => 'Nama Module wajib diisi.',
                'is_unique'     => 'Nama Module harus berisi nilai unik'
            ]
        ];
    }
}
