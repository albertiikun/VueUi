<?php

namespace Core\myvendor\common\Exceptions;

use Exception;

class GroupNotExistsException extends Exception
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
        return response('Group not found try again!', 423);
    }
}
