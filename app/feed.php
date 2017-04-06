<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feed extends Model
{
    //
    protected $fillable = ['title','description','content','grabbed_content','link','datasource_feed_id','published_date'];

    public function datasources_feed()
    {
        return $this->belongsTo('femtosh\theaggregator\models\datasources_feed');
    }

    public function category()
    {
        return $this->belongsTo('femtosh\theaggregator\models\category');
    }

}
