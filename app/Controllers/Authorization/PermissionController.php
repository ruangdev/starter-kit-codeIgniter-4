<?php

namespace App\Controllers\Authorization;

use App\Controllers\BaseController;

class PermissionController extends BaseController
{
    public function index()
    {
        return view('Admin/Authorization/Permission/index');
    }
}
