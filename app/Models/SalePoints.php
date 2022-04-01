<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePoints extends Model
{
    use HasFactory;

    protected $fillable = ['name','adress','company_id'];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function user_sale_points(){
        return $this->hasMany(UserSalePoints::class);
    }
}
