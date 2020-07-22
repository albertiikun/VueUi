<?php

namespace Core\myvendor\functions\meteor;

interface IMeteor
{
    public function Send($classpath, $data = null);
}
