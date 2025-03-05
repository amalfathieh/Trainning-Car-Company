<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function store(CarRequest $request)
    {
        $request->validate([
            'name'=>'required|string|unique:categories'
        ]);
        $category = Category::create([
            'name'=>$request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => ' added successfully',
            'category' => $category], 201);
    }

    public function getAll(){
        $categories = Category::all();
        return response()->jaon([
            'success' => true,
            'categories' => $categories]);
    }

}
