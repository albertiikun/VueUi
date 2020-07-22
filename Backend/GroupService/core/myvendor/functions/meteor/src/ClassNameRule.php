<?php

namespace Core\myvendor\functions\meteor\src;

use Core\myvendor\common\exceptions\meteor\MeteorInvalidClassNameException;

trait ClassNameRule
{
    private function ClassName($parsedPath)
    {
        if (strpos($parsedPath, 'Handler')) {
            $validator = substr($parsedPath, 0, strpos($parsedPath, 'Handler')) . 'Validator';
            return $validator;
        } else {
            throw new MeteorInvalidClassNameException();
        }
    }
}
