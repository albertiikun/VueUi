<?php

namespace Core\myvendor\common\Exceptions\updateGroup;

use Exception;

class MaxLevelReachedExcetion extends Exception
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
        return response('Max level must not be lower than level', 422);
    }
}
