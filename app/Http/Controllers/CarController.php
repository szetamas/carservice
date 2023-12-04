<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
  public function index()
  {
    try {
      $cars = Car::all();
      return response()->json($cars, 200);
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      //DONT SEND $th, MAY IT COULD HAS SENSITIVE DATA
      return response()->json(['message' => 'Something went wrong with get cars'], 500);
    }
  }

  public function loadDefaultData()
  {
    $carsFilePath = base_path('database/datas/cars.json');
    if (file_exists($carsFilePath)) {
      $jsonCars = file_get_contents($carsFilePath);
      $cars = json_decode($jsonCars, true);

      if (json_last_error() === JSON_ERROR_NONE) {
        echo "loading cars datas into DB...";
        foreach ($cars as $car) {
          $car['accidents'] = $car['accident'];
          unset($car['accident']);
          Car::create($car);
        }

        echo "cars datas loaded into DB ";
        return response()->json(['message' => 'cars JSON datas are loaded'], 200);
      } else {
        echo "something went wrong with cars JSON :/ ";
        return response()->json(['message' => 'something went wrong with cars JSON :/'], 500);
      }
    } else {
      echo "cars JSON datas not found ";
      return response()->json(['message' => 'cars JSON datas not found'], 400);
    }
  }

  public function getLatestService(Request $request)
  {
    try {
      $car_id = $request->input('car_id');
      if (Car::find($car_id) === null) {
        return response()->json(['message' => 'Car isn\'t found'], 400);
      }
      $car = Car::with([
        'services' => function ($query) {
          $query->latestTime();
        }
      ])->find($car_id);
      return response()->json($car->services[0], 200);
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      //DONT SEND $th, MAY IT COULD HAS SENSITIVE DATA
      return response()->json(['message' => 'Something went wrong with get last service for car'], 500);
    }
  }
  public function getServicesForCar(Request $request)
  {
    try {
      $car_id = $request->input('car_id');
      $car = Car::find($car_id);
      if ($car === null) {
        return response()->json(['message' => 'Car isn\'t found'], 400);
      }
      $services = $car->services;
      return response()->json($services, 200);
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      //DONT SEND $th, MAY IT COULD HAS SENSITIVE DATA
      return response()->json(['message' => 'Something went wrong with get services for car'], 500);
    }
  }
}

?>