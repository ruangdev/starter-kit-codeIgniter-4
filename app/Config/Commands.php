<?php

namespace Config;

use App\Commands\SuperAdminCommand;

class Commands extends \CodeIgniter\Config\Commands
{
    public $commands = [
        SuperAdminCommand::class,
    ];
}
