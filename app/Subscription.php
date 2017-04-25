<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['user_id', 'name', 'subscription_key', 'plan_id', 'trial_ends_at', 'ends_at','status','number_of_domains','is_category'];

    protected $dates = [
        'created_at',
        'updated_at',
        'ends_at',
        'trial_ends_at'
    ];
    public function feeds()
    {
        return $this->hasMany('App\Subscription_feed', 'subscription_id');
    }
    public function category_feeds()
    {
        return $this->hasMany('App\Subscription_category', 'subscription_id');
    }

    public function transaction()
    {
        return $this->hasOne('App\Transaction');
    }

    public function plan()
    {
        return $this->belongsTo('App\Plan', 'plan_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function domain()
    {
        return $this->hasMany('App\Subscription_domain');
    }
}
