<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
  protected $fillable = [
    'id',
    'name',
    'card_number',
  ];
  //BECAUSE OF GDPR AND OTHER LEGAL ISSUES MAY WE DONT WANA STORE ID CARD NUMBERS
  public $timestamps = false;
  public function cars()
  {
    return $this->hasMany(Car::class);
  }

  public function services()
  {
    return $this->hasManyThrough(Service::class, Car::class);
  }
}

?>