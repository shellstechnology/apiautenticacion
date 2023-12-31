<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::prefix('v1')->group(function () {
    Route::post('/user', [UserController::class, "Registrar"]);
    Route::get('/validate', [UserController::class, "ValidarToken"])->middleware('auth:api');
    Route::get('/logout', [UserController::class, "Logout"])->middleware('auth:api');
    Route::post('/login', [UserController::class,'Login']);

});
