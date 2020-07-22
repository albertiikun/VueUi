<?php
namespace Functional\swagger\commands\register\src;

use Illuminate\Http\Request;

trait SetContent
{
    public function SetContent(Request $request)
    {
        $file = fopen(base_path() . "/app//" . $request->fileName . '.php', "a") or die('Cannot open file: ' . $request->fileName);

        $content = file_get_contents(__DIR__ . '/contents/SwaggerContent.php', false);
        $content = str_replace('##METHOD##', $request->method, $content);
        $content = str_replace('##URI##', $request->uri, $content);
        $content = str_replace('##SUMMARY##', $request->summary, $content);
        $content = str_replace('##TAG##', $request->tag, $content);

        $fileProperty = '';
        foreach ($request->property as $key => $property) {
            $fileProperty .= file_get_contents(__DIR__ . '/contents/PropertyContent.php', false);
            $fileProperty = str_replace('##PROPERTYNAME##', $property['name'], $fileProperty);
            $fileProperty = str_replace('##PROPERTYTYPE##', $property['type'], $fileProperty);
        }
        $content = str_replace('*##PROPERTY##', $fileProperty, $content);

        fwrite($file, $content);
        fclose($file);
    }
}
