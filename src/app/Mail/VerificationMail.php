<?php

// app/Mail/VerificationMail.php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class VerificationMail extends Mailable
{
    public $verificationUrl;

    public function __construct($verificationUrl)
    {
        $this->verificationUrl = $verificationUrl;
    }

    public function build()
    {
        return $this->view('auth.email')
                    ->with([
                        'verificationUrl' => $this->verificationUrl
                    ]);
    }
}
