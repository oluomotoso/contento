<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picasaphoto extends Model
{
    protected $fillable = ['picasa_id', 'original_url', 'picasa_link', 'api_data_id'];

}
