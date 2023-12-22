<?php

namespace App\Controllers\Admin;

use Config\Database;
use Config\Services;
use App\Helpers\UUID;
use App\Models\Users;
use Myth\Auth\Password;
use App\Models\UserProfile;
use \Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Repository\User\UserResponse;
use App\Validation\User\StoreValidation;
use App\Validation\User\UpdateValidation;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->db           = Database::connect();
        $this->UserResponse = New UserResponse();
    }

    public function index()
    {
        if($this->request->isAJAX()) {
            $result = $this->UserResponse->datatable();
            return DataTable::of($result)->addNumbering('no')
                                        ->add('action', function($action){
                                            return  '
                                                        <a href="'.route_to('admin.user.edit', $action->id).'" type="button" class="btn btn-primary btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm delete-btn")
                                                                data-uuid="'.$action->id.'">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    ';
                                        })
                                        ->edit('active', function($active){
                                            if((boolean) $active->active == true) {
                                                return  '
                                                            <button type="button" class="btn btn-primary btn-sm status-btn")
                                                                data-uuid="'.$active->id.'">
                                                                <i class="fas fa-user-check"></i>
                                                            </button>
                                                        ';
                                            } elseif ((boolean) $active->active == false) {
                                                return  '
                                                            <button type="button" class="btn btn-danger btn-sm status-btn")
                                                                data-uuid="'.$active->id.'">
                                                                <i class="fas fa-user-lock"></i>
                                                            </button>
                                                        ';
                                            }
                                        })
                                        ->toJson(true);
        }
            return view('Admin/User/index');
    }

    public function create()
    {
        return view('Admin/User/create');
    }

    public function store()
    {
        $validationRules    = StoreValidation::rules();
        $validationMessages = StoreValidation::messages();
        $validation         = Services::validation();
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

    public function update($id)
    {
        $validationRules    = UpdateValidation::rules($id);
        $validationMessages = UpdateValidation::messages($id);
        $validation         = Services::validation();
        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->db->transBegin();
        try {
            $param = $this->request->getRawInput();
            $this->UserResponse->update($param, $id);
                $notification = [
                    'message'     => 'Successfully updated Admin.',
                    'alert-type'  => 'success',
                    'gravity'     => 'bottom',
                    'position'    => 'right'
                ]; 
                    return redirect()->to(route_to('admin.user.list'))->with('message', $notification);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            $notification = [
                'message'     => 'Failed to updated Admin.',
                'alert-type'  => 'danger',
                'gravity'     => 'bottom',
                'position'    => 'right'
            ];   
                return redirect()->to(route_to('admin.user.list'))->with('message', $notification);
        } finally {
            $this->db->transCommit();
        }
    }

    public function delete($id)
    {
        try {
            $this->UserResponse->delete($id);
            $success = true;
            $message = "Successfully to Delete Data Admin.";
        } catch (\Throwable $th) {
            $success = false;
            $message = "Failed to Delete data Admin.";
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

    public function status($id)
    {
        try {
            $this->UserResponse->status($id);
            $success = true;
            $message = "Successfully to Change Status Admin.";
        } catch (\Throwable $th) {
            $success = false;
            $message = "Failed to Change Status Admin.";
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
}
