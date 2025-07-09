<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BusinessClient;

class ClientWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $password;

    public function __construct(BusinessClient $client, $password)
    {
        $this->client = $client;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your ' . config('app.name') . ' Account Details')
                   ->view('default.panel.business.clients.client_welcome');
    }
}