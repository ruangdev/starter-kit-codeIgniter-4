<?php

namespace App\Controllers\Admin;

use Config\Services;
use App\Helpers\UUID;
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
                                            return  "
                                                        <a href='" . route_to('admin.user.edit', $row->id) . "' type='button' class='btn btn-primary btn-sm'>
                                                            <i class='fas fa-edit'></i>
                                                        </a>
                                                        <button type='button' class='btn btn-danger btn-sm') >
                                                            <i class='fas fa-trash-alt'></i>
                                                        </button>
                                                    ";
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
        $validationRules = [
            'username' => 'required|min_length[8]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
        ];

        // Pesan kustom untuk validasi khusus
        $validationMessages = [
            'username' => [
                'min_length' => 'Username sudah digunakan, silakan pilih yang lain.'
            ],
            'email' => [
                'is_unique' => 'Email sudah terdaftar, gunakan email lain.'
            ],
            'password' => [
                'min_length' => 'Panjang password minimal 8 karakter.'
            ],
        ];

        $validation = Services::validation();
        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->to(route_to('admin.user.create'))->withInput()->with('errors', $validation->getErrors());
        }

        try {
            $param = $this->request->getRawInput();
            $this->UserResponse->create($param);
            $notification = [
                'message'     => 'Successfully created Admin.',
                'alert-type'  => 'success',
                'gravity'     => 'bottom',
                'position'    => 'right'
            ]; 
                return redirect()->to(route_to('admin.user.list'))->with('message', $notification);
        } catch (\Throwable $th) {
            $notification = [
                'message'     => 'Failed to create Admin.',
                'alert-type'  => 'danger',
                'gravity'     => 'bottom',
                'position'    => 'right'
            ];   
                return redirect()->to(route_to('admin.user.list'))->with('message', $notification);
        }
    }

    public function edit($id)
    {
        $result = $this->UserResponse->find($id);
            return view('Admin/User/edit',compact('result'));
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
