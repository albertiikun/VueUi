<?php

namespace Functional\user\commands\updatePassword;

use Domain\entities\User;

trait UpdatePasswordModels
{
   

    public function getThisUser($id)
    {
        return User::where('id', $id)->first();
    }
}
