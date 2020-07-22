<?php

namespace Core\myvendor\common\exceptions\swagger;

use Exception;

class DuplicatedPropertyException extends Exception
{
    private $_fileName;
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
        return response('Duplicated Property', 400);
    }
}
