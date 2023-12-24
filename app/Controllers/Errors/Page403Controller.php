<?php

namespace App\Controllers\Errors;

use App\Controllers\BaseController;

class Page403Controller extends BaseController
{
    public function index()
    {
        return view('Admin/layout/errors/403');
    }
}
