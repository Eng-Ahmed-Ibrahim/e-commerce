<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Test extends Mailable
{
    use Queueable, SerializesModels;

    public $data=[];
    public function __construct()
    {
    }

    public  function build()
    {
        return $this
        ->view('emails.test')
        ->with("data",$this->data)
        ;

    }
}
