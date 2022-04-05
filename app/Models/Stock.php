<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'salepoint_id',
        'stock'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function salepoint(){
        return $this->belongsTo(SalePoints::class);
    }
}
