<?php

namespace Functional\own\queries\forgotPassword;

use Domain\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordNotification extends Mailable
{

    use Queueable, SerializesModels;

    private $_token;
    private $_userModel;
    public function __construct($token, User $user)
    {
        $this->_token = $token;
        $this->_userModel = $user;
    }
    //build the message.
    public function build()
    {
        return $this->view('ForgotPassword-Email', ['token' => $this->_token, 'user' => $this->_userModel])
            ->subject('Reset Password Link');
    }
}
