<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datasource extends Model
{
    protected $fillable = ['url', 'user_id'];
    protected $table = 'datasources';

    public function datasource_feeds()
    {
        return $this->hasMany('App\datasource_feed');
    }
}
