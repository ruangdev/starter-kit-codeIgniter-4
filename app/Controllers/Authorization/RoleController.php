<?php

namespace App\Controllers\Authorization;

use Config\Services;
use \Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Repository\Role\RoleResponse;
use App\Validation\Role\StoreValidation;
use App\Validation\Role\UpdateValidation;

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
                                <a href="'.route_to('admin.role.edit', $action->uuid).'" type="button" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm delete-btn")
                                        data-uuid="'.$action->uuid.'">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <a href="'.route_to('admin.role.view', $action->uuid).'" type="button" class="btn btn-success btn-sm">
                                    <i class="fas fa-folder-open"></i>
                                </a>
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

    public function edit($id)
    {
        $result = $this->RoleResponse->find($id);
        if(empty($result)) {
            return view('Admin/layout/errors/404');
        } else {
            return view('Admin/Authorization/Role/edit',compact('result'));
        }
    }

    public function update($id)
    {
        $validationRules    = UpdateValidation::rules($id);
        $validationMessages = UpdateValidation::messages();
        $validation         = Services::validation();
        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        
        try {
            $param  = $this->request->getRawInput();
            $result = $this->RoleResponse->update($param, $id);
            $notification = [
                'message'     => 'Successfully Updated Role.',
                'alert-type'  => 'success',
                'gravity'     => 'bottom',
                'position'    => 'right'
            ]; 
                return redirect()->to(route_to('admin.role.list'))->with('message', $notification);
        } catch (\Throwable $th) {
            $notification = [
                'message'     => 'Failed to Update Role.',
                'alert-type'  => 'danger',
                'gravity'     => 'bottom',
                'position'    => 'right'
            ];   
                return redirect()->to(route_to('admin.role.list'))->with('message', $notification);
        }
    }

    public function delete($id)
    {
        try {
            $this->RoleResponse->delete($id);
            $success = true;
            $message = "Successfully to Delete Data Role.";
        } catch (\Throwable $th) {
            $success = false;
            $message = "Failed to Delete data Role.";
        }
            if($success == true) {
                /**
                 * Return response true
                 */
                return $this->response->setJSON([
                    'success' => $success,
                    'message' => $message,
                ]);
            } elseif ($success == false) {
                /**
                 * Return response false
                 */
                return $this->response->setJSON([
                    'success' => $success,
                    'message' => $message,
                ]);
            }
    }

    public function view($id)
    {
        $result = $this->RoleResponse->find($id);
        if(empty($result)) {
            return view('Admin/layout/errors/404');
        } else {
            return view('Admin/Authorization/Role/view',compact('result'));
        }
    }
}
