<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountVerified extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@pepeleads.com', 'PepeLeads Network')
                    ->subject('Thank you for registering on PepeLeads Network')
                    ->view('emails.account_verified')
                    ->with([
                        'user' => $this->user,
                    ]);
    }
}
