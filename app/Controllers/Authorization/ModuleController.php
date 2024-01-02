<?php

namespace App\Controllers\Authorization;

use Config\Services;
use \Hermawan\DataTables\DataTable;
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
        if($this->request->isAJAX()) {
            $result = $this->ModuleResponse->datatable();
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
            return view('Admin/Authorization/Module/index');
    }
}
