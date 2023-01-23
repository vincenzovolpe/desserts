<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dessert extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nome', 'descrizione', 'immagine', 'prezzo', 'disponibilita', 'vendita'
    ];

    /**

     * Get the user that owns the dessert.

     */

     public function user()

     {

         return $this->belongsTo(User::class);

     }

     public function ingredients()
     {
         return $this->belongsToMany(Ingredient::class, 'desserts_ingredients', 'desserts_id','ingredients_id')->withPivot('quantita', 'unita_misura');
     }
}
