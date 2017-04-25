<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription_category extends Model
{
    protected $table = 'subscription_categories';
     protected $fillable = ['category_id','subscription_id'];

    public function category()
    {
        return $this->belongsTo('App\category','category_id');
    }

}
