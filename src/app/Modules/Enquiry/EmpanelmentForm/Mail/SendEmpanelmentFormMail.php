<?php

namespace App\Modules\Enquiry\EmpanelmentForm\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmpanelmentFormMail extends Mailable
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

        $mail = $this->subject('SNNRAJCORP - Enquiry')->view('email.empanelment_form')->with([
            'data' => $this->detail
        ])
        ->attach(storage_path(str_replace("storage","app/public",$this->detail->pan_image)))
        ->attach(storage_path(str_replace("storage","app/public",$this->detail->gst_image)))
        ->attach(storage_path(str_replace("storage","app/public",$this->detail->seal_image)))
        ->attach(storage_path(str_replace("storage","app/public",$this->detail->cheque_image)))
        ->attach(storage_path(str_replace("storage","app/public",$this->detail->rera_image)));
        if($this->detail->msme){
            $mail->attach(storage_path(str_replace("storage","app/public",$this->detail->msme_image)));
        }

        return $mail;
    }

}
