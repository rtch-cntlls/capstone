<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $firstname;
    public $email;
    public $password;

    public function __construct($firstname, $email, $password)
    {
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Your New Account')
                    ->view('emails.customer-account-created');
    }
}
