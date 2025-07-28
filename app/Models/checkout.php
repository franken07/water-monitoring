<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'prod_name',
        'image',
        'price',
        'product_id',
        'user_id',
        'quantity',
        'delivery_status', // Add this field
    ];
}
