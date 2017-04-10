<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api_data extends Model
{
    protected $fillable = ['user_id','account_id','email','refresh_token','token'];
}
