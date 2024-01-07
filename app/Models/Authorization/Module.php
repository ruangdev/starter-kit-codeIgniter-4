<?php

namespace App\Models\Authorization;

use Illuminate\Database\Eloquent\Model;
use App\Models\Authorization\Permission;

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

    public function permissions()
    {
        return $this->hasMany(Permission::class,'id_auth_module','id');
    }
}
