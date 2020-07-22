<?php
namespace Core\myvendor\functions\mapper\settings;

use Illuminate\Support\Facades\Hash;

trait MapperHashSettings
{
    private function withHash($model, $requests, $hashing)
    {
        $hashings = explode('|', $hashing);

        foreach ($requests as $index => $value) {

            if (in_array($index, $hashings)) {
                $model->$index = Hash::make($value);
            } else {
                $model->$index = $value;
            }
        }
    }

    private function withoutHash($model, $requests)
    {
        foreach ($requests as $index => $value) {
            $model->$index = $value;
        }
    }

}
