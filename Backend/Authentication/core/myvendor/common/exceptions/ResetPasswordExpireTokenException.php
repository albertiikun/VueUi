<?php

namespace Core\myvendor\common\Exceptions;

use Exception;

class ResetPasswordExpireTokenException extends Exception
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
        return response('Your reset password token is expired', 401);
    }
}
