<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'variety',
        'description',
        'price_5kg',
        'price_10kg',
        'price_20kg',
        'price_30kg',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }
}
