<?php

namespace App\Models\Authorization;

use Illuminate\Database\Eloquent\Model;

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
}
