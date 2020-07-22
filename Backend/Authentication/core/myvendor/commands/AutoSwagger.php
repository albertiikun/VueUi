<?php
namespace Core\myvendor\commands;

use Core\myvendor\functions\swagger\Swagger;
use Illuminate\Console\Command;

class AutoSwagger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:generate {className}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate swagger file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $swagger = new Swagger();
        $swagger->Generate($this->argument('className'));

    }
}
