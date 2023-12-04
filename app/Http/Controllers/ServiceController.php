<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Car;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
  public function index()
  {
    try {
      $services = Service::all();
      return response()->json($services);
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      //DONT SEND $th, MAY IT COULD HAS SENSITIVE DATA
      return response()->json(['message' => 'Something went wrong with get services'], 500);
    }
  }

  public function loadDefaultData()
  {
    $servicesFilePath = base_path('database/datas/services.json');
    if (file_exists($servicesFilePath)) {
      $jsonServices = file_get_contents($servicesFilePath);
      $services = json_decode($jsonServices, true);

      if (json_last_error() === JSON_ERROR_NONE) {
        echo "loading services datas into DB...";
        foreach ($services as $service) {
          $service['log_number'] = $service['lognumber'];
          unset($service['lognumber']);
          if ($service['eventtime'] === null) {
            $car = Car::find($service['car_id']);
            $service['event_time'] = $car->registered;
          } else {
            $service['event_time'] = $service['eventtime'];
          }

          unset($service['eventtime']);
          Service::create($service);
        }

        echo "services datas loaded into DB ";
        return response()->json(['message' => 'services JSON datas are loaded'], 200);
      } else {
        echo "something went wrong with services JSON :/ ";
        return response()->json(['message' => 'something went wrong with services JSON :/'], 500);
      }
    } else {
      echo "services JSON datas not found ";
      return response()->json(['message' => 'services JSON datas not found'], 400);
    }
  }
}

?>