<?php

namespace Core\myvendor\common\Exceptions;

use Exception;

class IsRobotException extends Exception
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
        return response('Your device is unknown! You cannot make any action on this platform.', 423);
    }
}
