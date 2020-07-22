<?php

namespace Core\myvendor\functions\meteor;

use Illuminate\Http\Request;

interface IMeteorHandler
{
    public function Handler(Request $request);
}
