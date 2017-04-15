<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datasource_feed extends Model
{
    protected $fillable = ['name', 'description', 'datasource_id', 'status', 'url', 'last_modified', 'etag','do_grab'];
    protected $table = 'datasources_feeds';

    public function Datasource()
    {
        return $this->belongsTo('App\datasource', 'datasource_id');
    }

    public function feed()
    {
        return $this->hasMany('App\feed');
    }
}
