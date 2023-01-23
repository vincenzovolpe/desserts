<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public function desserts()
    {
        return $this->belongsToMany(Dessert::class, 'desserts_ingredients', 'ingredients_id', 'desserts_id');
    }
}
