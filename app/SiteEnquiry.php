<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteEnquiry extends Model
{
    //
    protected $table = 'site_enquiry';
    protected $fillable = ['name','email','subject','message'];
}
