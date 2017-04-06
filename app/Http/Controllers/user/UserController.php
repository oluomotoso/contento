<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('member.user.default');
    }

    public function Pricing()
    {
        return view('member.user.pricing');
    }
}
