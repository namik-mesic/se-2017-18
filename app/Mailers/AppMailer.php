<?php

/**
 * Created by PhpStorm.
 
 */
namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

class AppMailer
{
    protected $mailer;

    protected $from;

    protected $to;

    protected $view;

    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->$mailer = $mailer;
    }

    /**
     * @param User $user
     * Function that combines all data for sending a confirmation mail.
     */
    public function sendEmailConfirmationTo(User $user)
    {
        $this -> $to = $user->email;
        $this -> $view = 'email.confirm';
        $this -> $data = compact('user');

        $this -> deliver();
    }

    /**
     * Function that sends the e-mail address.
     */

    public function deliver()
    {
        $this -> $mailer -> send($this->view, $this->data, function($message){
            $message -> from($this -> from, 'Administrator')
                -> to($this -> to);
        });
    }

}