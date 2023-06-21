<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getClientInfo($clientId)
    {
        $client = User::with('employee', 'orders')->find($clientId);

        if (!$client) {
            return response()->json(['message' => 'Klient nie został znaleziony.'], 404);
        }

        return response()->json(['client' => $client], 200);
    }
    public function store(Request $request)
    {
        $client = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            // 'password' => $request->input('password')
        ]);

        return response()->json([
            'data' => $client
        ], 201);
    }

    public function show($id)
    {
        $client = User::findOrFail($id);

        return response()->json([
            'data' => $client
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $client = User::findOrFail($id);
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        // $client->password = $request->input('password');
        $client->save();

        return response()->json([
            'data' => $client
        ], 200);
    }

    public function destroy($id)
    {
        $client = User::findOrFail($id);
        $client->delete();

        return response()->json(null, 204);
    }
}