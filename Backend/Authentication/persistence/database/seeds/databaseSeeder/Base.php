<?php
namespace Persistence\database\seeds\databaseSeeder;

class Base
{
  use Clients;

  public function __construct()
  {
      $this->clients();
  }
}
