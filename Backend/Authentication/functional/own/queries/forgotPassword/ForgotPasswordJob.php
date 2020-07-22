<?php

namespace Functional\own\queries\forgotPassword;

use Core\myvendor\defaults\job\Job;
use Domain\Entities\User;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $_token;
    private $_userModel;

    public function __construct($token, User $user)
    {
        $this->_token = $token;
        $this->_userModel = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->_userModel->email)->send(new ForgotPasswordNotification($this->_token, $this->_userModel));
    }
}
