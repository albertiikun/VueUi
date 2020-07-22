<?php

namespace Core\myvendor\common\Exceptions;

use Exception;

class StudentLimitException extends Exception
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
        return response('Cannot add students!, Increase your student limit please', 422);
    }
}
