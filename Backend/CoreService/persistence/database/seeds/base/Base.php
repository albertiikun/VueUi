<?php

namespace Persistence\database\seeds\base;

class Base
{
  use Countries, Cities, Genders, Events;

  public function __construct()
  {
    $this->Countries();
    $this->Cities();
    $this->Genders();
    $this->seedEvents();
  }
}
