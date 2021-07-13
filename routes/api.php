<?php

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

Route::post('/register', [\App\Http\Controllers\API\AuthController::class,'register'])->name('register');
Route::post('/login', [\App\Http\Controllers\API\AuthController::class,'login'])->name('login');

Route::get('/events', [\App\Http\Controllers\API\EventController::class,'index'])->name('events.index');
Route::get('/events/{id}', [\App\Http\Controllers\API\EventController::class,'show'])->name('events.shoow');
Route::get('/events/{id}/stalls', [\App\Http\Controllers\API\EventController::class,'getEventStalls'])->name('events.getEventStalls');

Route::get('/stalls/{id}', [\App\Http\Controllers\API\EventController::class,'getStall'])->name('events.getStall');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('events/{event_id}/stalls/{stall_id}/book', [\App\Http\Controllers\API\BookingController::class,'bookStall'])->name('bookings.bookStall');
});


