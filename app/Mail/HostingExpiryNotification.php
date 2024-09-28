<?php

namespace App\Mail;

use App\Models\Hosting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HostingExpiryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $expiryDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Hosting $hosting)
    {
        $this->client = $hosting->client->name;
        $this->expiryDate = $hosting->expiry_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.hosting_expiry_notification')
                    ->subject('Hosting Expiry Notification');
    }
}
