<?php

namespace App\Controllers\Authorization;

use Config\Services;

use App\Controllers\BaseController;

class RoleController extends BaseController
{
    protected $authorize;
    public function __construct()
    {
        $this->authorize = service('authorization');
    }

    public function index()
    {
        $auth = Services::auth();
        // return view('Admin/Authorization/Role/index');
    }

    public function create()
    {

    }

    public function store()
    {
        $cache = \Config\Services::cache();
        $cache->clean();

        // dd(has_permission('show.users'));
        // $permission = $this->authorize->permission('show.users');

        // dd($permission);

        $group_id       = 1;
        $permission_id  = [1 ,2, 3];

        for ($i=0; $i < count($permission_id); $i++) {
            // $this->authorize->addPermissionToGroup($permission_id[$i], $group_id);
            $this->authorize->removePermissionFromGroup($permission_id[$i], $group_id);
        }
    }
}
