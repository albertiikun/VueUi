<?php
namespace Core\myvendor\functions\swagger\src;

trait Duplicated
{
    // RouteName would give the FileName
    public function DuplicatedFIleName($routeName, $statusCode, $object)
    {
        if ($statusCode == 401) {
            $object->info("Route requires authorization");
            return true;
        } else if ($routeName == "") {
            $object->info("Route Name must not be empty please check routes");
            return true;
        } else if (file_exists(base_path() . "/app/generated/" . $routeName . '.php')) {
            $object->info("File --| " . $routeName . " |-- already exists");
            return true;
        } else {
            return false;
        }
    }
}
