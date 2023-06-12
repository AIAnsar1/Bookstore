<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected array $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->to($this->data['to'])->subject('Email Verification')->markdown('mail.verification',$this->data);
    }
}