<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
  protected $fillable = [
    'id',
    'client_id',
    'car_id',
    'type',
    'registered',
    'ownbrand',
    'accidents',
  ];
  public $timestamps = false;

  public function services()
  {
    return $this->hasMany(Service::class);
  }
}

?>