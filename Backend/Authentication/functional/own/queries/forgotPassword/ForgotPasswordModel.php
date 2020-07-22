<?php

namespace Functional\own\queries\forgotPassword;

use Domain\Entities\PasswordReset;
use Domain\Entities\User;

trait ForgotPasswordModel
{
    private $_model;
    private $_userModel;

    public function __construct()
    {
        $this->_model = new PasswordReset();
        $this->_userModel = new User();
    }

}
