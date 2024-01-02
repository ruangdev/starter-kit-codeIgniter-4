<?php

namespace App\Controllers\Authorization;

use Config\Services;
use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
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
        if($this->request->isAJAX()) {
            $result = $this->PermissionResponse->datatable();
                return DataTable::of($result)->addNumbering('no')
                    ->add('action', function($action){
                        return  '
                                    <a href="'.route_to('admin.permission.edit', $action->uuid).'" type="button" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn")
                                            data-uuid="">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                ';
                    })
                ->toJson(true);
        }
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

    public function edit($id)
    {
        $result = $this->PermissionResponse->find($id);
        if(empty($result)) {
            return view('Admin/layout/errors/404');
        } else {
            $modules = $this->PermissionResponse->listModule();
                return view('Admin/Authorization/Permission/edit',compact('modules','result'));
        }
    }

    public function update($id)
    {
        $result = $this->PermissionResponse->update($id);
        return $this->response->setJSON([
            'data' => $result,
            ]);
    }
}
