<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'Invoice';
    protected $primaryKey = 'id';
    protected $fillable = [
        'invoice_number',
        'order_id',
        'total_amount',
        'created_at'
    ];

    public function orders(){
        return $this->belongsTo(Orders::class, order_id);
    }
}
