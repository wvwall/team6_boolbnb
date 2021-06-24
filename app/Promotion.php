<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public function apartment() {
        
        return $this->belongsToMany('App\Apartment');
        
      }
}
