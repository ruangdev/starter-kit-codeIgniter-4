<?php

namespace App\Repository\User;

interface UserDesign {
    public function datatable();
    public function create($param);
    public function find($id);
    public function update($param, $id);
    public function delete($id);
    public function status($id);
}