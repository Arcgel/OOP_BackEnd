<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $table = 'Ingredients';
    protected $primaryKey = 'Ingredient_code';
    protected $fillable = [
        'Ingredient_code',
        'Ingredient_name',
        'quantity',
        'unit'
    ];
}
