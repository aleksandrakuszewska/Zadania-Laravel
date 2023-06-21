<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\VehicleAssignedNotification;
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
    private function createVehicleNotifications($vehicle, $user)
    {
        $adminUser = User::where('admin_role', 'Administrator')->first();

        // Tworzenie notyfikacji dla użytkownika
        $userNotification = new Notification();
        $userNotification->user_id = $user->id;
        $userNotification->car_id = $vehicle->id;
        $userNotification->message = 'Samochód został przypięty.';
        $userNotification->save();

        if ($adminUser) {
            $adminNotification = new Notification();
            $adminNotification->user_id = $adminUser->id;
            $adminNotification->car_id = $vehicle->id;
            $adminNotification->message = 'Samochód został przypięty przez użytkownika '.$user->name.'.';
            $adminNotification->save();

            // Wysyłanie notyfikacji e-mail do administratora
            $adminUser->notify(new VehicleAssignedNotification());
        }

        // Wysyłanie notyfikacji e-mail do użytkownika
        $user->notify(new VehicleAssignedNotification());
    }
}