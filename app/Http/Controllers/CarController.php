<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    //
    public function create()
    {
        $car = new Car();

        $categories = Category::all();

        return view('dashboard.cars.create', compact('car','categories'));
    }

    public function store(Request $request)
    {

        $r = $request->category_id;
        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);

        //Mass assignment
        Car::create($data);

        //PRG
        return Redirect::route('dashboard.index')
            ->with('success','Car created');
    }
    public function destroy( $id)
    {

        $car = Car::findOrFail($id);
        $car->delete();
        if($car->image){
            Storage::disk('public')->delete($car->image);
        }

        $e =$car->category_id;
        return Redirect::route('dashboard.index',compact('e'))
            ->with('success','Car deleted');
    }
    public function delete($id)
    {
        Car::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'car deleted successfully'], 201);
    }

    public function show($id){

        $category = Category::findOrFail($id);
        $cars = $category->cars;
        return view('dashboard.cars.index', compact('cars'));
    }

    public function getAllCars(){
        $cars = Car::all();
        return response()->json([
            'cars' =>$cars,
            'success' => true,
        ], 200);
    }

    protected function uploadImage(Request $request){
        if(!$request->hasFile('image')){
            return;
        }
        $file = $request->file('image');
        $path = $file->store('upload',[
            'disk'=>'public'
        ]);
        return $path;
    }
}
