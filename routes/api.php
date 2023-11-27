<?php

use App\Http\Controllers\RaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('race', [RaceController::class, 'save']);
Route::get('race', [RaceController::class, 'index']);
Route::get('race/cancelled', [RaceController::class, 'findDeleted']);
Route::get('race/{id}', [RaceController::class, 'find']);
Route::delete('race/{id}', [RaceController::class, 'delete']);
