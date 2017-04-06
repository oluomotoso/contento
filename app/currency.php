<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class currency extends Model
{
    //
    protected $fillable = ['country','rate_to_usd'];
}
