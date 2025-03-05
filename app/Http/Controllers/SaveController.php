<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function saveCare($carId)
    {
        $user = Auth::user();
        $car = Car::find($carId);
        if($car) {
            if ($user->savedCars()->where('opportunity_id', $carId)->exists()) {
                $user->savedCars()->detach($car);
                $message = 'car deleted from saved items';
            }
            else {
                $user->savedCars()->attach($car);
                $message = 'car added to save items';
            }
            return response()->json([
                'success' => true,
                'message' => $message,
                ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => ' car not found'], 404);
    }
    public function getSavedItems(){
        $user = Auth::user();
        $savedItems = $user->savedOpportunities;
        return response()->json([
            'success' => true,
            'cars' => $savedItems], 200);
    }
}
