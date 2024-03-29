<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\UserController;
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


Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login'])->name('login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/appointment/create',[AppointmentController::class,'createAppointment']);
    Route::put('/appointment/update',[AppointmentController::class,'updateAppointment']);
    Route::delete('/appointment/delete',[AppointmentController::class,'deleteAppointment']);
    Route::get('/appointment/list',[AppointmentController::class,'getUserAppointmentList']);
    Route::get('/appointment/list/all',[AppointmentController::class,'getAllAppointmentList']);

    Route::post('/logout',[UserController::class,'logout']);
    Route::post('/refresh',[UserController::class,'refresh']);
});
