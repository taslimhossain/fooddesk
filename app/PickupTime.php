<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupTime extends Model
{
    protected $fillable = ['day','from','to'];
}
