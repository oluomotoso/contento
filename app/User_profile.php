<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    protected $fillable = ['user_id', 'currency_id', 'country'];

    public function currency()
    {
        return $this->belongsTo('App\currency');
    }
}
