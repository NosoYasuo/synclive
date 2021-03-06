<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function watches()
    {
        return $this->hasMany('App\Watch');
    }

    public function channels()
    {
        return $this->hasMany('App\Channel');
    }

    public function room_u1s()
    {
        return $this->hasMany('App\Room', 'user1');
    }

    public function room_u2s()
    {
        return $this->hasMany('App\Room', 'user2');
    }
}
