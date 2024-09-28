<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class stock extends Mailable
{
    use Queueable, SerializesModels;
    public $maildata;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($maildata)
    {
        $this->maildata =$maildata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('SENDER_EMAIL'))
        // ->to('shakyasubish@gmail.com')
                    ->subject('You have a New Message')
                    ->view('emails.signup');
    }
    public function content()
    {
         return new Content(
            view: 'Backend.email',
        );

    }
    public function envelope() :Envelope
    {
        $subject = 'Stock level is low ' . $this->maildata['name'];
        return new Envelope(
            // from: new Address($this->maildata['email'],$this->maildata['name'] ),
            replyTo: [
                new Address($this->maildata['email'],$this->maildata['name'] ),
            ],
            subject: $subject,
        );
    }
}
