<?php

namespace App\Repository\Role;

use Config\Database;
use App\Helpers\UUID;
use App\Models\Authorization\Role;
use App\Repository\Role\RoleDesign;

class RoleResponse implements RoleDesign {

    protected $db;
    protected $Role;
    protected $uuid;

    public function __construct()
    {
        $this->db   = Database::connect();
        $this->Role = new Role();
        $this->uuid = UUID::create();
    }

    public function datatable()
    {
        return $this->db->table('auth_groups');
    }

    public function store($param)
    {
        $this->Role->create([
            'uuid'          =>$this->uuid,
            'name'          =>$param["role_name"],
            'description'   =>$param["role_description"],
        ]);
    }

    public function find($id)
    {
        return $this->Role->whereUuid($id)->first();
    }

    public function update($param, $id)
    {
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
}