<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // specify the table name if different from the model name

    protected $fillable = [
        'prod_name', 'image', 'price', 'category', 'description',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
