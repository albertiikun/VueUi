<?php

namespace Core\myvendor\common\Exceptions;

use Exception;

class RestrictionIpAddresseAlreadyExists extends Exception
{

    private $_data;

    public function __construct($data)
    {
        $this->_data = $data;
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
        return response([
            'msg' => 'This ip Address already exists',
            'ipAddress' => $this->_data,
        ], 200);

    }
}
