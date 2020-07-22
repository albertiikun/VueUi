<?php
namespace Functional\swagger\commands\register\src;

use Core\myvendor\common\exceptions\swagger\DuplicatedPropertyException;

trait DuplicatedProperty
{
    public function DuplicatedProperty($properties)
    {
        $duplicated = [];

        foreach ($properties as $key => $property) {
            $duplicated[] = $property['name'];
        }

        if (count(array_unique($duplicated)) < count($duplicated)) {
            throw new DuplicatedPropertyException();
        }

    }
}
