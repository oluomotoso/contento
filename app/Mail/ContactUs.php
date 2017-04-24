<?php

namespace App\Mail;

use App\SiteEnquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $enquiry;

    public function __construct(SiteEnquiry $enquiry)
    {
        $this->enquiry = $enquiry;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->enquiry->email)
            ->subject('SITE ENQUIRY: ' . $this->enquiry->subject)
            ->view('emails.contact');
    }
}
