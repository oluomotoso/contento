<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['subscription_id', 'amount', 'currency_id', 'status','discount','actual_cost'];

    public function currency()
    {
        return $this->belongsTo('App\currency', 'currency_id');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Subscription', 'subscription_id');
    }
}
