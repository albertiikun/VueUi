<?php

namespace Core\myvendor\common\Exceptions;

use Exception;
use Illuminate\Http\Request;

class UserIsAlreadyAddedException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return response('User is already exists on this group', 422);
    }
}
