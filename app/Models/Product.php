<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'variety',
        'stock_5kg',
        'stock_10kg',
        'stock_20kg',
        'stock_30kg',
        'price_5kg',
        'price_10kg',
        'price_20kg',
        'price_30kg',
        'description',
    ];
}
