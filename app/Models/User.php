<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const GUEST_ROLE = 0;
    public const ADMIN_ROLE = 1;

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
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ADMIN_ROLE;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        switch ($this->role) {
            case 1:
                return 'Admin';
            default:
                return 'User';
        }
    }

    /**
     * @return string
     */
    public function getInitials(): string
    {
        return $this->name[0] . $this->surname[0];
    }
}
