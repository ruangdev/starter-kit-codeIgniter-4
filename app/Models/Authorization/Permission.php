<?php

namespace App\Models\Authorization;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table    = 'auth_permissions';
    // 	$id = $authorize->createPermission('blog.posts.manage', 'Allows a user to create, edit, and delete blog posts.');

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,
     * string>
     */
    protected $fillable = [
        'uuid',
        'id_auth_module',
        'name',
        'description'
    ];
}
