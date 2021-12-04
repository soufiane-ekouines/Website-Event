<?php

use App\Http\Controllers\Api\CommandeController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::middleware(['auth:api'])->group(function () {
        Route::post('log_out',[AuthController::class,'logout'])->name('logout');
        Route::resource('Event', EventController::class);
        Route::resource('Commande', CommandeController::class);
        Route::get('Commande/{id_user}/{id_event}', [CommandeController::class,'show']);
        Route::post('Commande/{id_user}/{id_event}', [CommandeController::class,'update']);
        Route::delete('Commande/{id_user}/{id_event}', [CommandeController::class,'destroy']);


        
        Route::resource('Event', EventController::class);

    });
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::post('register',[AuthController::class,'register'])->name('register');

});