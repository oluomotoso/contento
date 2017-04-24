<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feed_category extends Model
{
    //
    protected $table = 'feed_categories';
    protected $fillable = ['feed_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\category');
    }

    public function feed()
    {
        return $this->belongsTo('App\feed');
    }
}
