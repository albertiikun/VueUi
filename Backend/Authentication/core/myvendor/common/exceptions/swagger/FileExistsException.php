<?php

namespace Core\myvendor\common\exceptions\swagger;

use Exception;

class FileExistsException extends Exception
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

    public function __construct($fileName)
    {
        $this->_fileName = $fileName;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return response($this->_fileName . ' file already exists', 400);
    }
}