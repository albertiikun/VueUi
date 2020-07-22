<?php

namespace Functional\user\commands\undelete;

use Domain\entities\User;

trait UndeleteModels
{
   
    private function Undelete($id)
    {
       User::onlyTrashed()->find($id)->restore();
    }

}
