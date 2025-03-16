<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['name','image','description'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
