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
//Public Routes
Route::post('/register',[\App\Http\Controllers\AuthController::class,'register']);
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);
Route::get('/tickets',[\App\Http\Controllers\TicketController::class,'index']);
Route::get('/tickets/{id}',[\App\Http\Controllers\TicketController::class,'index']);
Route::get('/tickets/search/{department}',[\App\Http\Controllers\TicketController::class,'search']);

Route::group(['middleware' => ['auth:sanctum']], function () {
   Route::post('/tickets',[\App\Http\Controllers\TicketController::class,'store']);
    Route::put('/tickets/{id}',[\App\Http\Controllers\TicketController::class,'update']);
    Route::delete('/tickets/{id}',[\App\Http\Controllers\TicketController::class,'destroy']);
    Route::post('/logout',[\App\Http\Controllers\AuthController::class,'logout']);
    Route::post('/profile/change-password',[\App\Http\Controllers\ProfileController::class,'change_password']);
    Route::post('password/email',[\App\Http\Controllers\ForgotPasswordController::class,'forgot']);
    Route::post('password/reset',[\App\Http\Controllers\ForgotPasswordController::class,'reset'])->name('password.reset');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
