<?php
namespace Core\myvendor\functions\swagger\src;

trait PrepareContent
{

    /**
     * PrepareProperties
     *
     * @param array $properties
     * @param string $type
     * @return string $fileProperty
     */
    public function PrepareProperties(array $properties, string $type)
    {
        $fileProperty = '';
        foreach ($properties as $property) {
            $fileProperty .= file_get_contents(__DIR__ . '//contents/' . $type . '/propertyContent.php', false);
            $fileProperty = str_replace('##PROPERTYNAME##', $property, $fileProperty);
            $fileProperty = str_replace('##PROPERTYTYPE##', 'string', $fileProperty);
        }
        return (string) $fileProperty;
    }

    /**
     * PrepareAnnotationBulder
     *
     * @param array $dictionary
     * @param string $fileProperty
     * @param string $type
     * @return string $content
     */
    public function PrepareAnnotationBulder(array $dictionary, string $fileProperty, string $type)
    {
        $method = strtolower($dictionary["method"]);
        $content = file_get_contents(__DIR__ . '//contents/' . $type . '/buildContent.php', false);
        $content = str_replace('##METHOD##', ucfirst($method), $content);
        $content = str_replace('##URI##', $dictionary["uri"], $content);
        $content = str_replace('##SUMMARY##', $dictionary["routeName"], $content);
        $content = str_replace('##TAG##', $dictionary["ControllerName"], $content);
        $content = str_replace('*##PROPERTY##', $fileProperty, $content);

        return (string) $content;
    }
}
