<?php

namespace Core\myvendor\functions\swagger;

use Core\myvendor\functions\swagger\src\Duplicated;
use Core\myvendor\functions\swagger\src\PrepareContent;

class SwaggerFactory
{
    use Duplicated, PrepareContent;

    /**
     * Handler
     *
     * @param mixed $jsonDecodes
     * @param mixed $dictionary
     * @param mixed $statusCode
     * @param mixed $object
     * @return void
     */
    public function Handler($jsonDecodes, $dictionary, $statusCode, $object)
    {

        if ($this->DuplicatedFIleName($dictionary["routeName"], $statusCode, $object) == false) {
            if ($dictionary["method"] != "GET") {
                $this->PostMethod(array_keys($jsonDecodes), $statusCode, $dictionary);
            } else {
                if ($jsonDecodes == null) {
                    $properties = "*";
                } else {
                    $properties = array_keys($jsonDecodes);
                }
                $this->GetMethod($properties, $statusCode, $dictionary);
            }
        }
    }

    /**
     * PostMethod
     *
     * @param mixed $properties
     * @param mixed $statusCode
     * @param mixed $dictionary
     * @return void
     */
    public function PostMethod($properties, $statusCode, $dictionary)
    {
        if ($statusCode == 422) {
            $file = fopen(base_path() . "/app/generated/" . $dictionary["routeName"] . '.php', "a") or die('Cannot open file: ' . $$dictionary["routeName"]);

            $fileProperty = $this->PrepareProperties($properties, 'body');

            $content = $this->PrepareAnnotationBulder($dictionary, $fileProperty, 'body');

            $this->WriteAndClose($file, $content);
        }
    }

    /**
     * GetMethod
     *
     * @param mixed $properties
     * @param mixed $statusCode
     * @param mixed $dictionary
     * @return void
     */
    public function GetMethod($properties, $statusCode, $dictionary)
    {
        if ($properties != null && $statusCode == 422) {
            $fileProperty = $this->PrepareProperties($properties, 'query');
        } else {
            $fileProperty = "*";
        }

        $file = fopen(base_path() . "/app/generated/" . $dictionary["routeName"] . '.php', "a") or die('Cannot open file: ' . $dictionary["routeName"]);

        $content = $this->PrepareAnnotationBulder($dictionary, $fileProperty, 'query');

        $this->WriteAndClose($file, $content);
    }

    /**
     * WriteAndClose
     *
     * @param mixed $file
     * @param string $content
     * @return void
     */
    public function WriteAndClose($file, string $content)
    {
        fwrite($file, $content);
        fclose($file);
    }
}
