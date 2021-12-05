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

        Route::prefix('Commande/{id_user}/{id_event}')->group(function () {
        Route::get('/', [CommandeController::class,'show'])->name('cemmande.show');
        Route::post('/', [CommandeController::class,'update'])->name('commande.add');
        Route::delete('/', [CommandeController::class,'destroy'])->name('commande.delete');
        });
        Route::get('Cmd/event/{eventdeid}', [CommandeController::class,'cmd_event'])->name('cemmande.cio');
        Route::get('Cmd/user/{id_user}', [CommandeController::class,'cmd_user'])->name('cemmande.user');

        Route::prefix('Event/evalu')->group(function () {
        Route::get('/show-moyenne/{event_id}', [EventController::class,'showevalu_event_moy'])->name('evalu.moy');
        Route::get('/{event_id}', [EventController::class,'showevalu_event'])->name('evalu.show');
        Route::get('/{event_id}/{user_id}', [EventController::class,'showevalu_user'])->name('evalu.show_user');
        Route::post('/', [EventController::class,'evalu'])->name('evalu.add');
        Route::post('/{event_id}/{user_id}', [EventController::class,'evalu_update'])->name('evalu.update');
        Route::delete('/{event_id}/{user_id}', [EventController::class,'evalu_delete'])->name('evalu.delete');



            
        });
        // eval route 
        
        Route::resource('Event', EventController::class);

    });
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::post('register',[AuthController::class,'register'])->name('register');

});