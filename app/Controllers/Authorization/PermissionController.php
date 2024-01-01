<?php

namespace App\Controllers\Authorization;

use Config\Services;
use App\Controllers\BaseController;
use App\Validation\Permission\StoreValidation;
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

    public function store()
    {
        $validationRules    = StoreValidation::rules();
        $validationMessages = StoreValidation::messages();
        $validation         = Services::validation();
        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->to(route_to('admin.permission.create'))->withInput()->with('errors', $validation->getErrors());
        }
            try {
                    $param = $this->request->getRawInput();
                    $this->PermissionResponse->create($param);
                    $notification = [
                        'message'     => 'Successfully created Permission.',
                        'alert-type'  => 'success',
                        'gravity'     => 'bottom',
                        'position'    => 'right'
                    ]; 
                        return redirect()->to(route_to('admin.permission.list'))->with('message', $notification);
            } catch (\Throwable $th) {
                    $notification = [
                        'message'     => 'Failed to created Permission.',
                        'alert-type'  => 'danger',
                        'gravity'     => 'bottom',
                        'position'    => 'right'
                    ];   
                        return redirect()->to(route_to('admin.permission.list'))->with('message', $notification);
            }
    }
}
