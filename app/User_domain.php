<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_domain extends Model
{
    protected $fillable = ['url', 'domain_id', 'user_id', 'platform_id', 'api_data_id'];

    public function api_data()
    {
        return $this->belongsTo('App\Api_data');
    }

}
