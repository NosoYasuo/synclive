<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

   public function watches()
   {
       return $this->belongsToMany('App\Watch', 'watch_tags');
   }
}
