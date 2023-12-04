<?php

namespace App\Providers;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CarController;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  public function boot()
  {
    $this->checkAndLoadDefaultData();
  }
  public function checkAndLoadDefaultData()
  {
    if (\DB::table('clients')->count() === 0) {
      app(ClientController::class)->loadDefaultData();
    }
    if (\DB::table('cars')->count() === 0) {
      app(CarController::class)->loadDefaultData();
    }
    if (\DB::table('services')->count() === 0) {
      app(ServiceController::class)->loadDefaultData();
    }
  }
}

?>