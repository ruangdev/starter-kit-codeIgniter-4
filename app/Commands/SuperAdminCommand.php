<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class SuperAdminCommand extends BaseCommand
{
    protected $group       = 'custom';
    protected $name        = 'custom:command';
    protected $description = 'Deskripsi dari custom command.';

    public function run(array $params)
    {
        CLI::write('Command kustom dijalankan!', 'green');
    }
}
