<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Job_feed extends Model
{
    //
    use Eloquence;
    protected $fillable = ['title', 'description', 'content', 'industry', 'link', 'position', 'company', 'location', 'datasource_feed_id'];

    public function datasources_feed()
    {
        return $this->belongsTo('App\datasource_feed', 'datasource_feed_id');
    }
}
