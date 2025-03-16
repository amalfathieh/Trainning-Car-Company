<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



Route::resource('/dashboard', CategoriesController::class)
->middleware('auth');

Route::resource('/cars', CarController::class)
    ->middleware('auth');
