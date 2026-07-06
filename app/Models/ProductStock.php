<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = [
        'product_id',
        'crop_year',
        'stock_5kg',
        'stock_10kg',
        'stock_20kg',
        'stock_30kg',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
