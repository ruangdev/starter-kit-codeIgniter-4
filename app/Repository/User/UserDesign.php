<?php

namespace App\Repository\User;

interface UserDesign {
    public function datatable();
    public function create($param);
}