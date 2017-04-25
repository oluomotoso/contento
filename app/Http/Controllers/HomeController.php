<?php

namespace App\Http\Controllers;

use App\feed;
use App\Mail\ContactUs;
use App\SiteEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function PostContact(Request $request)
    {
        $contact = SiteEnquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        Mail::to('info@femtosh.com')->send(new ContactUs($contact));
        return redirect('/')->with('message', 'Thanks for contacting us, your message have been sent successfully. We will get back to you shortly');
    }

    public function LatestContents()
    {
        $today = new \DateTime();
        $contents = feed::where('created_at', '>', $today->modify('-7 day'))->orderBy('updated_at', 'desc')->paginate(20);
        return view('demo-contents', ['contents' => $contents]);
    }

    public function GetContent($id, $csrf)
    {
        if (csrf_token() == $csrf) {
            $feed = feed::select('id', 'title', 'content')->find($id);
            if (count($feed) > 0) {
                return view('content-detailed', ['content' => $feed]);

            }
        }
        echo 'invalid request';
    }
}
