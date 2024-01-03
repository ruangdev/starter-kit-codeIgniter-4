<?php

namespace App\Controllers\Authorization;

use Config\Services;
use \Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Repository\Module\ModuleResponse;
use App\Validation\Module\StoreValidation;

class ModuleController extends BaseController
{
    protected $ModuleResponse;
    public function __construct()
    {
        $this->ModuleResponse = new ModuleResponse;
    }

    public function index()
    {
        if($this->request->isAJAX()) {
            $result = $this->ModuleResponse->datatable();
            return DataTable::of($result)->addNumbering('no')
                ->add('action', function($action){
                    return  '
                                <a href="'.route_to('admin.module.edit', $action->id).'" type="button" class="btn btn-primary btn-sm">
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
            return view('Admin/Authorization/Module/index');
    }

    public function create()
    {
        return view('Admin/Authorization/Module/create');
    }

    public function store()
    {
        $validationRules    = StoreValidation::rules();
        $validationMessages = StoreValidation::messages();
        $validation         = Services::validation();
        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->to(route_to('admin.module.create'))->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $param = $this->request->getRawInput();
            $this->ModuleResponse->store($param);
            $notification = [
                'message'     => 'Successfully created Module.',
                'alert-type'  => 'success',
                'gravity'     => 'bottom',
                'position'    => 'right'
            ]; 
                return redirect()->to(route_to('admin.module.list'))->with('message', $notification);
        } catch (\Throwable $th) {
            $notification = [
                'message'     => 'Failed to created Module.',
                'alert-type'  => 'danger',
                'gravity'     => 'bottom',
                'position'    => 'right'
            ];   
                return redirect()->to(route_to('admin.module.list'))->with('message', $notification);
        }
    }

    public function edit($id)
    {
        return view('Admin/Authorization/Module/edit');
    }
}
