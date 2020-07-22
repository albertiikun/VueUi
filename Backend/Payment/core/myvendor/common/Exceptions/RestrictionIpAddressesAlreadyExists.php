<?php

namespace Core\myvendor\common\Exceptions;

use Exception;

class RestrictionIpAddressesAlreadyExists extends Exception
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
            'msg' => 'Those ip addresses already exists',
            'ipAddresses' => $this->_data,
        ], 200);
    }
}
