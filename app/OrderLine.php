<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'fid');
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
