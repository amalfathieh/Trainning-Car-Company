<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    protected $fillable = ['brand', 'model', 'year', 'color', 'price', 'category_id', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function savedByUsers() {
        return $this->belongsToMany(User::class, 'saves');
    }
}
