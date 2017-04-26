<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publishing_parameter extends Model
{
    protected $fillable = ['identifier_id', 'parameters', 'subscription_domain_id', 'to_draft', 'publish_all'];

    public function subscription_domain()
    {
        return $this->belongsTo('App\Subscription_domain');
    }
}
