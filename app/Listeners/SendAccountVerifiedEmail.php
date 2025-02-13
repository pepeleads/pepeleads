<?php
namespace App\Listeners;

use App\Mail\AccountVerified;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Queue;

class SendAccountVerifiedEmail implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Verified  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
        Mail::to($user->email)
            ->bcc(['surveytitans1@gmail.com', 'maliksanayakhan@gmail.com'])
            ->send(new AccountVerified($user));
    }
}
