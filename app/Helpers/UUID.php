<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class UUID {

    public static function create()
    {
        return str_replace('-', '', Str::uuid()->toString());
    }

}