<?php

namespace Core\myvendor\functions\meteor;

use Core\myvendor\functions\meteor\src\ValidatorGenerator;

class Meteor implements IMeteor
{
    use ValidatorGenerator;

    private $_IMeteorHandler;

    public function Send($classpath, $data = null)
    {
        if ($data) {
            $validatorData = $this->Validator($classpath, $data);

        } else {
            $validatorData = [];
        }

        $meteor = new MeteorRequestHandler(new $classpath);

        return $meteor->Handle($validatorData, $data);
    }
}
