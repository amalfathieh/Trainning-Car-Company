<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIsAdmin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::controller(UserController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('logout',[UserController::class,'logout']);

    Route::controller(CarController::class)->group(function (){
        Route::post('addNewCar','store')->middleware(CheckIsAdmin::class);
        Route::get('delete/car/{id}','delete')->middleware(CheckIsAdmin::class);

        Route::get('getAllCars','getAllCars');
        Route::get('getByCategory/{id}','getByCategory');
    });

    Route::controller(Category::class)->group(function (){
        Route::post('addNewCategory','store')->middleware(CheckIsAdmin::class);

        Route::get('getAllCategory','getALL');
    });

    Route::controller(SaveController::class)->group(function () {
        Route::get('save/{car_id}','saveCare');

        Route::get('getSave','getSavedItems');
    });

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
