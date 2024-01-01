<?php

namespace App\Repository\Role;

use App\Models\Authorization\Role;
use App\Repository\Role\RoleDesign;

class RoleResponse implements RoleDesign {

    protected $Role;
    public function __construct(Role $Role)
    {
        $this->Role = $Role;
    }

    public function store()
    {
        # code...
    }
}