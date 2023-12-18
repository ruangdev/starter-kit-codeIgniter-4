<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table        = 'user_profile';
    protected $keyType      = 'string';
    public $incrementing    = false;
    protected $primaryKey   = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,
     * string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'fullName',
        'imageName',
        'pathImage',
        'numberPhone',
        'TeleID'
    ];
}
