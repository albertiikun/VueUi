<?php
namespace Functional\swagger\commands\register\src;

use Core\myvendor\common\exceptions\swagger\FileExistsException;

trait FileExists
{
    public function FileExists($fileName)
    {
        if (file_exists(base_path() . "/app//" . $fileName . '.php')) {
            throw new FileExistsException($fileName);
        }
    }
}
