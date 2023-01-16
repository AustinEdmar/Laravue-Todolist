<?php

namespace App\Listeners;

use App\Events\ForgotPassword;
use App\Mail\ForgotPasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendForgotPasswordNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

     // o event tem __construct(User $user, string $token) com parametro
    public function handle(ForgotPassword $event)
    {
        // e chamo a classe mail, pego o email do usuario actual, envio e passo template do mail, injecto token e user
        Mail::to($event->user->email)->send(new ForgotPasswordMail($event->user, $event->token ));
    }
}
