<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function store(Request $request)
    {
        $vehicle = Car::create([
            'brand' => $request->input('brand'),
            'model' => $request->input('model')
        ]);

        return response()->json([
            'data' => $vehicle
        ], 201);
    }

    public function show($id)
    {
        $vehicle = Car::findOrFail($id);

        return response()->json([
            'data' => $vehicle
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Car::findOrFail($id);
        $vehicle->brand = $request->input('brand');
        $vehicle->model = $request->input('model');
        $vehicle->save();

        return response()->json([
            'data' => $vehicle
        ], 200);
    }

    public function destroy($id)
    {
        $vehicle = Car::findOrFail($id);
        $vehicle->delete();

        return response()->json(null, 204);
    }
}
