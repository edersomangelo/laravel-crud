<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const TYPE_ADMIN = 'admin';
    const TYPE_USER = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullname() {
        return "{$this->name} {$this->lastname}";
    }
    /**
     * Check if the user is admin
     *
     * @return bool
     */
    public function isAdmin()    {
        return $this->type === self::TYPE_ADMIN;
    }
}
