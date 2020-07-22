<?php

namespace Persistence\database\seeds\base;

class Base
{
    use Groups;

    public function __construct()
    {
      $this->Groups();
    }
}
