<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingDetails extends Model
{
    use HasFactory;

    protected $fillable =[
        'price',
        'quantity',
        'product_id',
        'shopping_id'
    ];
}
