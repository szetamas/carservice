<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarController;

Route::get('/clients', [ClientController::class, 'index']);
//THESE ARE 'POSTS' AND NOT 'GETS' BECAUSE 'GET' MAY NOT AS SECURE AS NEEDED
Route::post('/client/cars', [ClientController::class, 'getCarsForClient']);
Route::post('/client/search', [ClientController::class, 'getSearchedClient']);
Route::post('/car/latestservice', [CarController::class, 'getLatestService']);
Route::post('/car/services', [CarController::class, 'getServicesForCar']);

?>