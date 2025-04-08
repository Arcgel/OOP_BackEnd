<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'Order';
    protected $primaryKey = 'id';
    protected $fillable = [
      'product_id',
      'total_price',
      'date'
    ];

    public function products(){
        return $this->belongsTo(Products::class, 'product_id', 'Itemcode');
    }

}
