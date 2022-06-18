<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method static create(array $array)
 * @method static findOrFail($id)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const IMAGES_PATH = 'images/users';
    const USER_NO_PHOTO_IMAGE_NAME = 'user.svg';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'job_title',
        'education',
        'certificates',
        'image',
        'address',
        'email',
        'password',
        'role',
        'news',
        'surveys',
        'promotions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasOne
     */
    public function userRole(): HasOne
    {
        return $this->hasOne('App\Models\Role', 'id', 'role');
    }

    /**
     * @return string
     */
    public function getInitials(): string
    {
        return $this->name[0] . $this->surname[0];
    }
}
