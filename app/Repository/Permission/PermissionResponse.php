<?php

namespace App\Repository\Permission;

use Config\Database;
use App\Helpers\UUID;
use App\Repository\Permission\PermissionDesign;
use App\Models\Authorization\Module;
use App\Models\Authorization\Permission;

class PermissionResponse implements PermissionDesign {

    protected $db;
    protected $Permission;
    protected $Module;
    protected $uuid;

    public function __construct()
    {
        $this->db           = Database::connect();
        $this->Permission   = new Permission();
        $this->Module       = new Module();
        $this->uuid         = UUID::create();
    }

    public function datatable()
    {        
        return $this->db->table('auth_permissions')
                ->select('auth_permissions.uuid,
                          auth_permissions.id_auth_module,
                          auth_permissions.name,
                          auth_permissions.description,
                          auth_module.module_name,
                          auth_permissions.created_at')
                ->join('auth_module',
                        'auth_module.id = auth_permissions.id_auth_module'
                );
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

    public function find($id)
    {
        return $this->db->table('auth_permissions')
                        ->select('auth_permissions.uuid,
                                auth_permissions.id_auth_module,
                                auth_permissions.name,
                                auth_permissions.description,
                                auth_module.module_name,
                                auth_permissions.created_at')
                        ->join('auth_module',
                                'auth_module.id = auth_permissions.id_auth_module'
                        )
                        ->where('auth_permissions.uuid',$id)
                        ->get()->getRow();
    }

    public function update($id)
    {
        return $id;
    }
}