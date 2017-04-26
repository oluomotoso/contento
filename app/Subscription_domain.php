<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription_domain extends Model
{
    protected $fillable = ['url', 'subscription_id', 'platform_id', 'user_domain_id'];

    public function api_data()
    {
        return $this->hasOne('App\Api_data');
    }

    public function user_domain()
    {
        return $this->belongsTo('App\User_domain');
    }

    public function subscription(){
        return $this->belongsTo('App\Subscription');
    }
}
