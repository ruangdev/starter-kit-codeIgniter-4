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
        # code...
    }
}