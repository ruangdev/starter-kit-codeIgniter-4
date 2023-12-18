<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table        = 'user_profile';
    protected $keyType      = 'string';
    public $incrementing    = false;

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

    /**
     * Generator UUID4
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->id = str_replace('-', '', Uuid::uuid4()->toString());
            } catch (\Exception $e) {
                abort(500);
            }
        });
    }
}
