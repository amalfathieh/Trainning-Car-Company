<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'brand' => 'Toyota',
                'model' => 'Camry',
                'year' => 2023,
                'color' => 'Silver',
                'price' => '200',
                'category_id' => '6',
                'image' => 'upload/generic-red-suv-on-a-white-background-side-view.jpg'
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Civic',
                'year' => 2022,
                'color' => 'Red',
                'price' => '456',
                'category_id' => '6',
                'image' => 'upload/3d-illustration-of-generic-compact-red-suv.jpg'
            ],
            [
                'brand' => 'Ford',
                'model' => 'F-150',
                'year' => 2021,
                'color' => 'Red',
                'price' => '250',
                'category_id' => '5',
                'image' => 'upload/3d-illustration-of-generic-compact-red-suv.jpg'
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Silverado',
                'year' => 2020,
                'color' => 'Black',
                'price' => '100',
                'category_id' => '7',
                'image' => ''
            ],
            [
                'brand' => 'BMW',
                'model' => 'X5',
                'year' => 2024,
                'color' => 'White',
                'price' => '375',
                'category_id' => '7',
                'image' => ''
            ],
        ];

        foreach ($cars as $carData) {
            Car::create($carData);
        }
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
