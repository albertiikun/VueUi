<?php
namespace Core\myvendor\commands;

use Illuminate\Console\Command;

class DatabaseLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'link database to \host\database';

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
        $from = $this->from();

        $to = $this->to();

        if (file_exists($to)) {
            return $this->error('The "\host\database" directory already exists.');
        }

        $this->laravel->make('files')->link(
            $from, $to
        );
        $this->info('The "\host\database" is created successfuly.');
    }

    public function from()
    {
        $from = __DIR__;
        $from = implode('\\', explode('\\', $from, -3));
        $from = $from . '\lumen\database';

        return $from;
    }

    public function to()
    {
        $to = __DIR__;
        $to = implode('\\', explode('\\', $to, -3));
        $to = $to . '\host\database';

        return $to;
    }
}
