<?php

namespace App\Controllers\Admin;

use App\Models\Users;
use Myth\Auth\Password;
use App\Models\UserProfile;
use \Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Repository\User\UserResponse;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->UserResponse = New UserResponse();
    }

    public function index()
    {
        if($this->request->isAJAX()) {
            $result = $this->UserResponse->datatable();
            return DataTable::of($result)->addNumbering('no')
                                        ->add('action', function($row){
                                            return  '
                                                        <button type="button" class="btn btn-primary btn-sm") ><i class="fas fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-sm") ><i class="fas fa-trash-alt"></i></button>
                                                    ';
                                        })->toJson(true);
        }
            return view('Admin/User/index');
    }

    public function create()
    {
        return view('Admin/User/create');
    }

    public function store()
    {
        $param = "Data";
        $this->UserResponse->create($param);
    }

    public function edit()
    {
        # code...
    }

    public function update()
    {
        # code...
    }

    public function inactive()
    {
        # code...
    }
}
