<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSalePoints extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'salepoint_id'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function sale_points(){
        return $this->hasMany(SalePoints::class);
    }
}
