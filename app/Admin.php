<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * Relationships that should be eager loaded with the model
     *
     * @var array
     */
    protected $with = ['role'];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isSuper()
    {
        return $this->role->name === 'super';
    }

    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }

    public function isSeo()
    {
        return $this->role->name === 'seo';
    }

    public function isViewer()
    {
        return $this->role->name === 'viewer';
    }
}
