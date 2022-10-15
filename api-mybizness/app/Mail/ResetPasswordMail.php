<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $reset;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reset)
    {
        $this->reset = $reset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reset = $this->reset;
        $reset->token = url('')."/app/reset/password/".$reset->token;
        return $this->from('noreply@cfg.re')
            ->view('mails.resetPasswordMail', compact('reset'))
            ->subject('Votre changement de mot de passe');
    }
}
