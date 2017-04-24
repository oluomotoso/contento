<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    protected $fillable = ['category'];

    public function feed_category()
    {
        return $this->hasMany('App\feed_category');
    }

    public function Feed()
    {
        return $this->hasManyThrough('App\feed', 'App\feed_category');
    }

    public function FeedCount()
    {
        return $this->feed_category()
            ->selectRaw('category_id, count(*) as count')
            ->groupBy('category_id');
    }
}
