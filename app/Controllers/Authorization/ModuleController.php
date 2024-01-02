<?php

namespace App\Controllers\Authorization;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Repository\Module\ModuleResponse;

class ModuleController extends BaseController
{
    protected $ModuleResponse;
    public function __construct()
    {
        $this->ModuleResponse = new ModuleResponse;
    }

    public function index()
    {
        return view('Admin/Authorization/Module/index');
    }
}
