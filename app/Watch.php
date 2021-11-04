<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function tags()
   {
       return $this->belongsToMany('App\Tag', 'post_tags'); 
   }

}
