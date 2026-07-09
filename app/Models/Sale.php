<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
     protected $fillable = [
        'product_stock_id',
        'sale_date',
        'customer_name',
        'size',
        'quantity',
        'unit_price',
        'total_price',
        'sale_method',
        'note',
    ];

    public function productStock()
    {
        return $this->belongsTo(ProductStock::class);
    }
}
