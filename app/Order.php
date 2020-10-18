<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected $dates = ['date'];
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
