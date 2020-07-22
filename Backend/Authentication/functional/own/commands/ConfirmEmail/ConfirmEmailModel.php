<?php

namespace Functional\own\commands\ConfirmEmail;

use Domain\Entities\EmailConfirmation;
use Domain\Entities\User;

trait ConfirmEmailModel
{
    private $_model;
    private $_userModel;

    public function __construct()
    {
        $this->_model = new EmailConfirmation;
        $this->_userModel = new User;
    }
}
