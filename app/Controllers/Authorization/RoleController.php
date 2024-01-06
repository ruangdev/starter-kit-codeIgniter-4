<?php

namespace App\Controllers\Authorization;

use Config\Services;
use \Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Repository\Role\RoleResponse;
use App\Validation\Role\StoreValidation;

class RoleController extends BaseController
{
    protected $RoleResponse;
    public function __construct()
    {
        $this->RoleResponse = new RoleResponse;
    }

    public function index()
    {
        if($this->request->isAJAX()) {
            $result = $this->RoleResponse->datatable();
            
            return DataTable::of($result)->addNumbering('no')
                ->add('action', function($action){
                    return  '
                                <a href="" type="button" class="btn btn-primary btn-sm">
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
            return view('Admin/Authorization/Role/index');
    }

    public function create()
    {
        return view('Admin/Authorization/Role/create');
    }

    public function store()
    {
        // $cache = \Config\Services::cache();
        // $cache->clean();

        // dd(has_permission('show.users'));
        // $permission = $this->authorize->permission('show.users');

        // dd($permission);

        // $group_id       = 1;
        // $permission_id  = [1 ,2, 3];

        // for ($i=0; $i < count($permission_id); $i++) {
            // $this->authorize->addPermissionToGroup($permission_id[$i], $group_id);
            // $this->authorize->removePermissionFromGroup($permission_id[$i], $group_id);
        // }

        $validationRules    = StoreValidation::rules();
        $validationMessages = StoreValidation::messages();
        $validation         = Services::validation();
        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->to(route_to('admin.role.create'))->withInput()->with('errors', $validation->getErrors());
        }
        
        try {
            $param = $this->request->getRawInput();
            $this->RoleResponse->store($param);
            $notification = [
                'message'     => 'Successfully created Role.',
                'alert-type'  => 'success',
                'gravity'     => 'bottom',
                'position'    => 'right'
            ]; 
                return redirect()->to(route_to('admin.role.list'))->with('message', $notification);
        } catch (\Throwable $th) {
            $notification = [
                'message'     => 'Failed to created Role.',
                'alert-type'  => 'danger',
                'gravity'     => 'bottom',
                'position'    => 'right'
            ];   
                return redirect()->to(route_to('admin.role.list'))->with('message', $notification);
        }
    }
}
