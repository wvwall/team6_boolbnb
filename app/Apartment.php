<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
  protected $fillable = [
    'title',
    'address',
    'city',
    'lat',
    'long',
    'n_rooms',
    'n_beds',
    'n_bathrooms',
    'square_meters',
    'thumb',
    'slug',
    'visibility',
    'user_id',
  ];
  public function user()
  {
  return $this->belongsTo('App\User');
  }

  public function messages() {
    return $this->hasMany('App\Message');
  }

  public function services() {

    return $this->belongsToMany('App\Service');
  }
  public function promotions() {

    return $this->belongsToMany('App\Promotion')->withTimestamps()->withPivot('expiration_date');;
  }
  public function views()
  {
    return $this->hasMany(View::class);
  }

}
