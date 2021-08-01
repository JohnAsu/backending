<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TvController;
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

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    
    Route::post('/tvs/search', [TvController::class, 'search']);
    Route::post('/tvs', [TvController::class, 'store']);
    Route::get('/tvs', [TvController::class, 'index']);

    Route::group(['middleware'=>'owner'], function() {
        Route::get('/tvs/{tv}', [TvController::class, 'show']);
        Route::put('/tvs/{tv}', [TvController::class, 'update']);
        Route::delete('/tvs/{tv}', [TvController::class, 'destroy']);
    });

});

