<?php

namespace Core\myvendor\common\Exceptions;

use Exception;

class ThisIpIsRestrictedException extends Exception
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
        return response('This ip address is restricted for you!', 401);
    }
}
