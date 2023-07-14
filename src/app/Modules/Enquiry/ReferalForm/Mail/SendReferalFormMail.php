<?php

namespace App\Modules\Enquiry\ReferalForm\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReferalFormMail extends Mailable
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

        return $this->subject('SNNRAJCORP - Enquiry')->view('email.referal_form')->with([
            'data' => $this->detail
        ]);
    }


}
