<?php

namespace App\Repository\Permission;

use App\Repository\Permission\PermissionDesign;
use App\Models\Authorization\Module;

class PermissionResponse implements PermissionDesign {

    protected $Module;
    public function __construct()
    {
        $this->Module = new Module;
    }

    public function listModule()
    {
        return $this->Module->latest()->get();
    }
}