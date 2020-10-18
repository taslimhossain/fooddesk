<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupTimeException extends Model
{
    protected $fillable = ['date','from','to'];
}
