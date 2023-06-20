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
    public function store(Request $request)
    {
        $client = Client::create([
            'name' => $request->input('name'),
            // 'email' => $request->input('email')
        ]);

        return response()->json([
            'data' => $client
        ], 201);
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);

        return response()->json([
            'data' => $client
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->name = $request->input('name');
        // $client->email = $request->input('email');
        $client->save();

        return response()->json([
            'data' => $client
        ], 200);
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(null, 204);
    }
}
