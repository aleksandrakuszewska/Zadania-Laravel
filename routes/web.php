<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserCarController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/client/{clientId}', [ClientController::class, 'getClientInfo']);
Route::post('/assign-car', [UserCarController::class, 'assignCar']);
Route::post('/check-user-car', [UserCarController::class, 'checkIfUserIsUsingCar']);