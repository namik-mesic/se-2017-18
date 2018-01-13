<?php
namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**

     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     *
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.verification');
    }
}