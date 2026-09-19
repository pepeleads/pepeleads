<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommonMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('constants.MAIL_FROM_ADDRESS'), 'PepeLeads Network')
                    ->subject($this->data['title'])
                    ->view('emails.common_template')
                    ->with([
                        'data' => $this->data['body'],
                    ]);
    }
}
