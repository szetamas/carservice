<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
  public function index()
  {
    try {
      $clients = Client::all();
      return response()->json($clients, 200);
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      return response()->json(['message' => 'Something went wrong with get the clients'], 500);
    }
  }

  public function loadDefaultData()
  {
    $clientsFilePath = base_path('database/datas/clients.json');
    if (file_exists($clientsFilePath)) {
      $jsonClients = file_get_contents($clientsFilePath);
      $clients = json_decode($jsonClients, true);

      if (json_last_error() === JSON_ERROR_NONE) {
        echo "loading clients datas into DB...";
        foreach ($clients as $client) {
          $client['card_number'] = $client['idcard'];
          unset($client['idcard']);
          Client::create($client);
        }

        echo "clients datas loaded into DB ";
        return response()->json(['message' => 'clients JSON datas are loaded'], 200);
      } else {
        echo "something went wrong with clients JSON :/ ";
        return response()->json(['message' => 'something went wrong with clients JSON :/'], 500);
      }
    } else {
      echo "clients JSON datas not found ";
      return response()->json(['message' => 'clients JSON datas not found'], 400);
    }
  }

  public function getCarsForClient(Request $request)
  {
    try {
      $client_id = $request->input('client_id');
      $client = Client::find($client_id);

      if (!$client) {
        return response()->json(['message' => 'Client isn\'t found'], 400);
      }

      $cars = $client->cars;

      return response()->json($cars, 200);
    } catch (\Throwable $th) {
      Log::error($th->getMessage());
      return response()->json(['message' => 'Something went wrong with get the cars of client'], 500);
    }
  }

  public function getSearchedClient(Request $request)
  {
    $client_name = $request->input('client_name');
    $client_id = $request->input('client_id');
    if (strlen($client_name) > 0) {
      if (strlen($client_id) > 0) {
        return response()->json(['message' => 'You could use just one input'], 400);
      } else {
        try {
          $clients = Client::withCount(['cars', 'services'])->where('name', 'like', "%$client_name%")->get();
          if (sizeof($clients) > 1) {
            return response()->json(['message' => 'Too much clients, may you should search for fullname'], 400);
          } else if (sizeof($clients) < 1) {
            return response()->json(['message' => 'Client not found '], 400);
          }
          return response()->json($clients[0], 200);
        } catch (\Throwable $th) {
          Log::error($th->getMessage());
          return response()->json(['message' => 'Something went wrong with search the client'], 500);
        }
      }
    } else if (strlen($client_id) > 0) {
      if (preg_match('/^[a-zA-Z0-9]+$/', $client_id)) {
        try {
          $clients = Client::withCount(['cars', 'services'])->where('card_number', $client_id)->get();
          return response()->json($clients[0], 200);
        } catch (\Throwable $th) {
          Log::error($th->getMessage());
          return response()->json(['message' => 'Something went wrong with search the client'], 500);
        }
      } else {
        return response()->json(['message' => 'Your id input could has just letters and numbers'], 400);
      }
    } else {
      return response()->json(['message' => 'You have to write something to one input '], 400);
    }
  }
}

?>