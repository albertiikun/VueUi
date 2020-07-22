<?php

namespace Functional\own\queries\loggedIn;

use Domain\Entities\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoggedInNotification extends Mailable
{

    use Queueable, SerializesModels;

    private $_requestIp;
    private $_userModel;
    private $_client;
    private $_os;
    private $_ipInfo;
    public function __construct($requestIp, User $user, $client, $os, $ipInfo)
    {
        $this->_requestIp = $requestIp;
        $this->_userModel = $user;
        $this->_client = $client;
        $this->_os = $os;
        $this->_ipInfo = $ipInfo;
    }
    //build the message.
    public function build()
    {
        return $this->view('LoggedIn', [
            'ip' => $this->_requestIp,
            'user' => $this->_userModel,
            'client' => $this->_client,
            'os' => $this->_os,
            'ipInfo' => $this->_ipInfo,
        ]);
    }
}
