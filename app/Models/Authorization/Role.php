<?php

namespace App\Models\Authorization;

use Illuminate\Database\Eloquent\Model;
use App\Models\Authorization\Permission;

class Role extends Model
{
    protected $table    = 'auth_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,
     * string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class,'id_auth_module','id');
    }
}
