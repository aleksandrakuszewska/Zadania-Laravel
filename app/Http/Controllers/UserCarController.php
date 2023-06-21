<?php
namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\Notification;
use App\Notifications\AccountDeactivatedNotification;
use App\Notifications\VehicleAssignedNotification;
class UserCarController extends Controller
{
    /**
     * Przypisuje użytkownika do samochodu.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignCar(Request $request): JsonResponse
    {
        // Walidacja danych wejściowych
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
        ]);
        $userId = $request->input('user_id');
        $carId = $request->input('car_id');
        // Przypisanie użytkownika do samochodu
        $user = User::findOrFail($userId);
        $car = Car::findOrFail($carId);
        $user->cars()->attach($car);
        // Tworzenie notyfikacji dla użytkownika
       /* $userNotification = new Notification();
        $userNotification->user_id = $user->id;
        $userNotification->car_id = $car->id;
        $userNotification->message = 'Samochód został przypisany';
        $userNotification->save();
        
        // Tworzenie notyfikacji dla administratora
        $adminUser = User::where('admin_role', 'Administrator')->first();
        if ($adminUser) {
            $adminNotification = new Notification();
            $adminNotification->user_id = $adminUser->id;
            $adminNotification->car_id = $car->id;
            $adminNotification->message = 'Samochód został przypisany'.$user->name.'.';
            $adminNotification->save();
        
            // Wysyłanie notyfikacji e-mail do administratora
            $adminUser->notify(new VehicleAssignedNotification());
        }
        // Wysyłanie notyfikacji e-mail do użytkownika
        $user->notify(new VehicleAssignedNotification());*/
        return response()->json([
            'message' => 'Użytkownik został przypisany do samochodu.'
        ]);
    }
    /**
     * Sprawdza, czy użytkownik korzysta z samochodu w danym momencie.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkIfUserIsUsingCar(Request $request): JsonResponse
    {
        // Walidacja danych wejściowych
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
        ]);
        $userId = $request->input('user_id');
        $carId = $request->input('car_id');
        // Sprawdzenie, czy użytkownik korzysta z samochodu w danym momencie
        $user = User::findOrFail($userId);
        $isUsingCar = $user->cars()->where('cars.id', $carId)->exists();
        if ($isUsingCar) {
            return response()->json([
                'message' => 'Użytkownik korzysta z samochodu.'
            ]);
        } else {
            return response()->json([
                'message' => 'Użytkownik nie korzysta z samochodu.'
            ]);
        }
    }
    public function deactivate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->active = false;
        $user->save();
        // Tworzenie notyfikacji dla użytkownika
        $userNotification = new Notification();
        $userNotification->user_id = $user->id;
        $userNotification->car_id = null;
        $userNotification->message = 'Twoje konto zostało dezaktywowane.';
        $userNotification->save();
        // Wysyłanie notyfikacji e-mail do użytkownika
        $user->notify(new AccountDeactivatedNotification());
        return response()->json([
            'message' => 'Konto zostało dezaktywowane.'
        ]);
    }
}