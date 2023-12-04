<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  protected $fillable = [
    'id',
    'client_id',
    'car_id',
    'log_number',
    'event',
    'event_time',
    'document_id',
  ];
  public $timestamps = false;

  public function scopeLatestTime($query)
  {
    return $query->latest('log_number')->first();
  }
}

?>