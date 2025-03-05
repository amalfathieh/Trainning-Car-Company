<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\Category;

class CarController extends Controller
{
    //
    public function store(CarRequest $request)
    {
        $validatedData = $request->validated();

        $car = Car::create($validatedData);

        return response()->json(['message' => 'car added successfully', 'data' => $car], 201);
    }

    public function delete($id)
    {
        Car::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'car deleted successfully'], 201);
    }

    public function getByCategory($id){
        $category = Category::findOrFail($id);
        $cars = $category->cars;
        return response()->json([
            'cars' =>$cars,
            'success' => true,
        ], 200);
    }

    public function getAllCars(){
        $cars = Car::all();
        return response()->json([
            'cars' =>$cars,
            'success' => true,
        ], 200);
    }
}
