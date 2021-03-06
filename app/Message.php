<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender',
        'object',
        'content',
        'apartment_id',
       'apartment_title',
       'user_id_apartment'
      ];
    public function apartment()
  {
  return $this->belongsTo('App\Apartment');
  }
}
