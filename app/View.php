<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
         'page_id',
         'ip_address'
     ];

     public function apartments()
     {
         return $this->belongsTo('App\Apartments');
     }
}
