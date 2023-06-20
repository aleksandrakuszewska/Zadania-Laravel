<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getClientInfo($clientId)
    {
        $client = Client::with('employee', 'orders')->find($clientId);

        if (!$client) {
            return response()->json(['message' => 'Klient nie został znaleziony.'], 404);
        }

        return response()->json(['client' => $client], 200);
    }
}
