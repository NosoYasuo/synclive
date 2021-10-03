<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['user1', 'user2'];

    public function get_user1()
    {
        return $this->belongsTo('App\User', 'user1');
    }

    public function get_user2()
    {
        return $this->belongsTo('App\User', 'user2');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
