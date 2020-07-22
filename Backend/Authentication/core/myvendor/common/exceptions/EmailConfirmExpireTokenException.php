<?php

namespace Core\myvendor\common\Exceptions;

use Exception;

class EmailConfirmExpireTokenException extends Exception
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
        return response('Your confrim email token is expired', 401);
    }
}
