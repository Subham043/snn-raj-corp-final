<?php

namespace App\Modules\Enquiry\ContactForm\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    private $detail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail)
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function build()
    {

        return $this->subject('SNNRAJCORP - Enquiry')->view('email.contact_form')->with([
            'data' => $this->detail
        ]);
    }


}
