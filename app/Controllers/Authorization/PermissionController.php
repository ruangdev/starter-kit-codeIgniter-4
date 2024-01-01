<?php

namespace App\Controllers\Authorization;

use App\Controllers\BaseController;
use App\Repository\Permission\PermissionResponse;

class PermissionController extends BaseController
{
    protected $PermissionResponse;
    public function __construct()
    {
        $this->PermissionResponse = new PermissionResponse;
    }

    public function index()
    {
        return view('Admin/Authorization/Permission/index');
    }

    public function create()
    {
        $modules = $this->PermissionResponse->listModule();
            return view('Admin/Authorization/Permission/create',compact('modules'));
    }
}
