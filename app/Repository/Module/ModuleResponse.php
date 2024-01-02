<?php

namespace App\Repository\Module;

use Config\Database;
use App\Helpers\UUID;
use App\Models\Authorization\Module;
use App\Repository\Module\ModuleDesign;

class ModuleResponse implements ModuleDesign {

    protected $db;
    protected $Module;
    protected $uuid;

    public function __construct()
    {
        $this->db           = Database::connect();
        $this->Module       = new Module();
        $this->uuid         = UUID::create();
    }

    public function datatable()
    {
        return $this->db->table('auth_module');
    }
}