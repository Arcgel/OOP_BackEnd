<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchiveProducts extends Model
{
    protected $table = 'archive_products';
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
