<?php

namespace App\Modules\Enquiry\CareerForm\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCareerFormMail extends Mailable
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

        return $this->subject('SNNRAJCORP - Enquiry')->view('email.career_form')->with([
            'data' => $this->detail
        ])->attach(storage_path(str_replace("storage","app/public",$this->detail->cv)), [
            'as' => 'cv.pdf',
            'mime' => 'application/pdf',
        ]);
    }


}
