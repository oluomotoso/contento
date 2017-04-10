<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feed extends Model
{
    //
    protected $fillable = ['title','description','content','grabbed_content','link','datasource_feed_id','published_date'];

    public function datasources_feed()
    {
        return $this->belongsTo('App\datasource_feed','datasource_feed_id');
    }

    public function category()
    {
        return $this->hasMany('App\feed_category');
    }

}
