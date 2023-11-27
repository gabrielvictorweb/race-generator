<?php

use App\Http\Controllers\RacingController;
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

Route::post('racing', [RacingController::class, 'save']);
Route::get('racing', [RacingController::class, 'index']);
Route::get('racing/cancelled', [RacingController::class, 'findDeleted']);
Route::get('racing/{id}', [RacingController::class, 'find']);
Route::delete('racing/{id}', [RacingController::class, 'delete']);
