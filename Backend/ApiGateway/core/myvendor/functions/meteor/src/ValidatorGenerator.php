<?php

namespace Core\myvendor\functions\meteor\src;

trait ValidatorGenerator
{
    use ClassNameRule, CreateValidatorFile;

    private function Validator($classpath, $data = null)
    {

        $parsedPath = (string) get_class($classpath);

        $validator = $this->ClassName($parsedPath);

        if (class_exists($validator)) {

            $class = new $validator;

            return $class->Validations($data);
        }
    }
}
