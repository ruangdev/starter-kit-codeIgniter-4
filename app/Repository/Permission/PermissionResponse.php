<?php

namespace App\Repository\Permission;

use App\Helpers\UUID;
use App\Repository\Permission\PermissionDesign;
use App\Models\Authorization\Module;
use App\Models\Authorization\Permission;

class PermissionResponse implements PermissionDesign {

    protected $Module;
    public function __construct()
    {
        $this->Permission   = new Permission;
        $this->Module       = new Module;
        $this->uuid         = UUID::create();
    }

    public function listModule()
    {
        return $this->Module->latest()->get();
    }

    public function create($param)
    {
        $this->Permission->create([
            'uuid'              =>$this->uuid,
            'id_auth_module'    =>$param['module'],
            'name'              =>$param['permissionName'],
            'description'       =>$param['permissionDescription']
        ]);
    }
}