<?php
namespace Core\myvendor\commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use mysqli;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new MySQL database based on the database config file or the provided name';

    private $_hostname;
    private $_username;
    private $_password;
    private $_charset;
    private $_collation;
    private $_database;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_database = config('dbconnect.CreateDatabase.database');
        $this->_hostname = config('dbconnect.CreateDatabase.servername');
        $this->_username = config('dbconnect.CreateDatabase.username');
        $this->_password = config('dbconnect.CreateDatabase.password');
        $this->_charset = config('dbconnect.CreateDatabase.charset');
        $this->_collation = config('dbconnect.CreateDatabase.collation');

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schemaName = $this->_database;

        $conn = $this->PrepareMysql();

        $query = "CREATE DATABASE $schemaName CHARACTER SET $this->_charset COLLATE $this->_collation;";

        // Create database
        if ($conn->query($query) === true) {
            $this->info('The database ' . $schemaName . ' is created successfuly.');
        } else {
            return $this->error('Database Already Exists');
        }

        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    private function PrepareMysql()
    {
        $conn = new mysqli($this->_hostname, $this->_username, $this->_password);

        // Check connection
        if ($conn->connect_error) {
            return $this->error('Database Connection failed');
        }

        $this->info('Database Connection Successfully');

        return $conn;

    }
}
