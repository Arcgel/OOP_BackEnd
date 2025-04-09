<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{

    use HasFactory, Notifiable , HasApiTokens;

    protected $table = 'client';
    protected $primaryKey = 'client_id';
    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'gender',
        'address',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
