<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'Sales';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'quantity_sold',
        'total_price',
        'sale_date'
    ];

    public function products(){
        return $this->belongsTo(Products::class, 'product_id', 'Itemcode');
    }

}
