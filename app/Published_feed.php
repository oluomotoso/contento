<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Published_feed extends Model
{
    protected $fillable = ['feed_id', 'subscription_id', 'domain_id'];
}
