<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription_feed extends Model
{
    protected $table = 'subscription_feeds';
    public $timestamps = false;
    protected $fillable = ['feed_id','subscription_id'];

    public function feed()
    {
        return $this->belongsTo('App\datasource_feed','feed_id');
    }
}
