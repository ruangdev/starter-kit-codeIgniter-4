<?php

namespace App\Repository\Role;

use Config\Database;
use Config\Services;
use App\Helpers\UUID;
use App\Models\Authorization\Role;
use Illuminate\Support\Facades\DB;
use App\Repository\Role\RoleDesign;
use App\Models\Authorization\Module;

class RoleResponse implements RoleDesign {

    protected $db;
    protected $Role;
    protected $Module;
    protected $uuid;

    public function __construct()
    {
        $this->db           = Database::connect();
        $this->Role         = new Role();
        $this->Module       = new Module();
        $this->authorize    = service('authorization');
        $this->uuid         = UUID::create();
    }

    public function datatable()
    {
        return $this->db->table('auth_groups');
    }

    public function store($param)
    {
        $cache = Services::cache();
        $cache->clean();

        $result = $this->Role->create([
            'uuid'          =>$this->uuid,
            'name'          =>$param["role_name"],
            'description'   =>$param["role_description"],
        ]);
            for ($i=0; $i < count($param["permissions"]); $i++) {
                $this->authorize->addPermissionToGroup($param["permissions"][$i], $result->id);
            }
    }

    public function find($id)
    {
        return $this->Role->whereUuid($id)->first();
    }

    public function findPermission($id)
    {
        return $this->db->table('auth_groups_permissions')->select('auth_groups_permissions.*, auth_permissions.name')
                        ->join('auth_permissions', 'auth_permissions.id = auth_groups_permissions.permission_id')
                        ->where('auth_groups_permissions.group_id', $id)
                        ->get()->getResult();
    }

    public function update($param, $findPermission, $group_id, $id)
    {
        $cache = Services::cache();
        $cache->clean();

        $this->db->table('auth_groups_permissions')->delete('group_id',$group_id);

        for ($i=0; $i < count($param["permissions"]); $i++) {
            $this->authorize->addPermissionToGroup($param["permissions"][$i], $group_id);
        }
        
        $this->Role->whereUuid($id)->update([
            'name'          =>$param["role_name"],
            'description'   =>$param["role_description"],
        ]);
    }

    public function delete($id)
    {
        $result = $this->Role->whereUuid($id);
        return $result->delete();
    }

    public function permission()
    {
       return $this->Module->with('permissions')
                          ->orderby('module_name','asc')
                          ->get();
    }
}