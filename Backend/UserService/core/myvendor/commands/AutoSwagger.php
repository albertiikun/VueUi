<?php

namespace Core\myvendor\commands;

use Core\myvendor\functions\swagger\SwaggerFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Request;

class AutoSwagger extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'swagger:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display all registered routes.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        global $app;

        $this->Reset();
        $this->DissableMiddlewares($app);
        $this->getRoutes($app);

        Artisan::call('swagger-lume:generate');

        return $this->info("command is excecuted successfully");

    }

    /**
     * Compile the routes into a displayable format.
     *
     * @return void
     */
    protected function getRoutes($app)
    {
        $routeCollection = property_exists($app, 'router') ? $app->router->getRoutes() : $app->getRoutes();
        $dictionaries = array();
        foreach ($routeCollection as $route) {
            if (strpos($this->getNamedRoute($route['action']), 'swagger-lume') === false) {
                $controllerPath = $this->getController($route['action']);
                $controllerName = class_basename($controllerPath[0]);
                $dictionaries[] = [
                    'uri' => $route['uri'],
                    'method' => $route['method'],
                    'routeName' => str_replace('Controller', '', $controllerName) . '-' . $controllerPath[1],
                    'ControllerName' => str_replace('Controller', '', $controllerName),
                ];
            }
        }
        $this->PrepareData($dictionaries, $app);
    }

    /**
     * Get route name
     *
     * @return string
     */
    protected function getNamedRoute(array $action)
    {
        return (!isset($action['as'])) ? "" : $action['as'];
    }

    /**
     * Get controller
     *
     * @return array
     * Controller name and method name
     */
    protected function getController(array $action)
    {
        if (empty($action['uses'])) {
            return 'None';
        }
        return explode("@", $action['uses']);
    }

    /**
     * Makes request to get data ready for SwaggerFactory
     *
     * @return array
     */
    public function PrepareData($dictionaries, $app)
    {
        foreach ($dictionaries as $dictionary) {
            $request = Request::create($dictionary['uri'], $dictionary['method']);
            $response = $app->dispatch($request);
            $jsonDecode = json_decode($response->getContent(), true);
            $this->SendDataToHandler($jsonDecode, $dictionary, $response->getStatusCode());
        }
    }

    /**
     * Deletes all old annotation
     *
     * @return void
     */
    public function Reset()
    {
        $files = glob(base_path() . "/app/generated/*");
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    /**
     * Disables all middlewares
     *
     * @return void
     */
    public function DissableMiddlewares($app)
    {
        $app->instance('middleware.disable', true);
    }

    /**
     * Send data to SwaggerFactory to create annotation
     *
     * @return void
     */
    public function SendDataToHandler($jsonDecode, $dictionary, $statusCode)
    {
        (new SwaggerFactory)->Handler($jsonDecode, $dictionary, $statusCode, $this);
    }
}
