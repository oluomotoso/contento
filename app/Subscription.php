<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['user_id', 'name', 'subscription_key', 'plan_id', 'trial_ends_at', 'ends_at'];

    public function feeds()
    {
        return $this->hasMany('femtosh\theaggregator\models\subscription_feed', 'subscription_id');
    }

    public function transaction()
    {
        return $this->hasOne('femtosh\theaggregator\models\transaction', 'transaction_id');
    }

    public function plan()
    {
        return $this->belongsTo('femtosh\theaggregator\models\plan', 'plan_id');
    }

    public function domain()
    {
        return $this->belongsTo('femtosh\theaggregator\models\user_website', 'user_website_id');
    }
}
