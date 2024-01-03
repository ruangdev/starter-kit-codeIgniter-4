<?php

namespace App\Repository\Module;

interface ModuleDesign {
    public function datatable();
    public function store($param);
    public function find($id);
    public function update($param, $id);
}