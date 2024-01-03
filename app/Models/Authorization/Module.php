<?php

namespace App\Models\Authorization;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table        = 'auth_module';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $primaryKey   = 'id';

    protected $fillable     = [
        'id',
        'module_name'
    ];
}
