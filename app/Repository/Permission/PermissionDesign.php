<?php

namespace App\Repository\Permission;

interface PermissionDesign {
    public function datatable();
    public function listModule();
    public function create($param);
}