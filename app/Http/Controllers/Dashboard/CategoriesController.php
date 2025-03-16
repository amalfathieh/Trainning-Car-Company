<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();

        return view('dashboard.categories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);

        //Mass assignment
         Category::create($data);

        //PRG
        return Redirect::route('dashboard.index')
            ->with('success','Category created');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $category = Category::findOrFail($id);
        $cars = $category->cars;
        return view('dashboard.cars.show', compact('cars'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $e){
            return redirect()->route('categories.index')
                ->with('info','Record not found');
        }
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $old_image = $category->image;

        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);

        $category->update($data);
        if($old_image && $data['image']){
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('dashboard.index')
            ->with('success','Category updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {

        $category = Category::findOrFail($id);
        $category->delete();
        if($category->image){
            Storage::disk('public')->delete($category->image);
        }
//        Category::destroy($id);
        return Redirect::route('dashboard.index')
            ->with('success','Category deleted');
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
