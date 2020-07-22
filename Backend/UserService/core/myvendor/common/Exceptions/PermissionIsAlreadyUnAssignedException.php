<?php

namespace Core\myvendor\common\Exceptions;

use Exception;

class PermissionIsAlreadyUnAssignedException extends Exception
{

    private $_data;

    public function __construct()
    {
    }
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
        return response('Permission is already unassigned', 422);
    }
}
