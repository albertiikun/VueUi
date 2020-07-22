<?php

namespace Core\container\port\setup;

class CallPort
{
    private $_IPort;

    private $_app;

    public function __construct(IPort $IPort, $app)
    {
        $this->_IPort = $IPort;
        $this->_app = $app;
    }

    public function PortHandler()
    {
        $this->_IPort->Register($this->_app);
    }
}
