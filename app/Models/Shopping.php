<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'items',
        'cash',
        'change',
        'status',
        'user_id',
        'provider_id',
        'salepoint_id',
    ];
}
