<?php

namespace Core\myvendor\common\Exceptions;

use Exception;
use Illuminate\Http\Request;

class EmailNotFoundException extends Exception
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
    public function render(Request $request)
    {
        return response($request->email . ' Not Found!', 404);
    }
}
