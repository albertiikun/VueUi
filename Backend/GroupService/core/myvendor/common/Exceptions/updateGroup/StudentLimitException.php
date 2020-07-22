<?php

namespace Core\myvendor\common\Exceptions\updateGroup;

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
        return response('You have to unassign some students to set lower limit.', 422);
    }
}
