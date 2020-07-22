<?php
namespace Functional\swagger\commands\register;

use Core\myvendor\functions\meteor\IMeteorHandler;
use Functional\swagger\commands\register\src\DuplicatedProperty;
use Functional\swagger\commands\register\src\FileExists;
use Functional\swagger\commands\register\src\SetContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SwaggerHandler implements IMeteorHandler
{
    use FileExists, DuplicatedProperty, SetContent;

    public function Handler(Request $request)
    {
        $this->FileExists($request->fileName);

        $this->DuplicatedProperty($request->property);

        $this->SetContent($request);

        try {
            Artisan::call('swagger-lume:generate');
            return "Method is created";
        } catch (\Throwable $th) {
            unlink(base_path() . "/app//" . $request->fileName . '.php');
            Artisan::call('swagger-lume:generate');
            return "Something went wrong please check url or something elese";
        }
    }
}
