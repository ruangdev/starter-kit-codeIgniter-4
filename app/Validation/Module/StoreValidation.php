<?php

namespace App\Validation\Module;

use CodeIgniter\Validation\Rules;

class StoreValidation extends Rules
{
    public static function rules(): array
    {
        return [
            'module' => 'required|is_unique[auth_module.module_name]',
        ];
    }

    public static function messages(): array
    {
        return [
            'module' => [
                'required'      => 'Nama Module wajib diisi.',
                'is_unique'     => 'Nama Module harus berisi nilai unik'
            ]
        ];
    }
}
