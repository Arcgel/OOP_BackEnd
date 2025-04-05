<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'Itemcode';
    protected $fillable = [
        'Itemcode',
        'Item_Name',
        'Description',
        'Unit_Price',
        'Quantity',
        'Image'
    ];
}
