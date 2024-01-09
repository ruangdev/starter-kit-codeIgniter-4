<?php

namespace App\Repository\Role;

interface RoleDesign {
    public function datatable();
    public function store($param);
    public function find($id);
    public function update($param, $findPermission, $group_id, $id);
    public function delete($id);
}