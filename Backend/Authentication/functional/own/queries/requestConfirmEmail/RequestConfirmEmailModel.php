<?php

namespace Functional\own\queries\requestConfirmEmail;

use Domain\Entities\EmailConfirmation;
use Domain\Entities\User;

trait RequestConfirmEmailModel
{
    private $_model;
    private $_userModel;

    public function __construct()
    {
        $this->_model = new EmailConfirmation;
        $this->_userModel = new User;
    }
}
