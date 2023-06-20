<?php
namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
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

        return response()->json([
            'message' => 'Użytkownik został przypisany do samochodu.'], 404);
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
                'message' => 'Użytkownik korzysta z samochodu.',
            ]);
        } else {
            return response()->json([
                'message' => 'Użytkownik nie korzysta z samochodu.',
            ]);
        }
    }
}
?>
