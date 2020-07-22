<?php

namespace Functional\groups\commands\activeUser;

use Core\myvendor\defaults\job\Job;
use Domain\entities\User;
use Twilio\Rest\Client;

class SmsNotificationJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $_accountSid;
    private $_authToken;
    private $_number;
    private $_userId;

    public function __construct($user_id)
    {
        $this->_userId = $user_id;
        $this->_accountSid = config('app.twilio.TWILIO_SID');
        $this->_authToken  = config('app.twilio.TWILIO_TOKEN');
        $this->_number     = config('app.twilio.TWILIO_NUMBER');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::where("id", $this->_userId)->first();

        $client = new Client($this->_accountSid, $this->_authToken);

        $client->messages->create("+351912197784", ['from' => $this->_number, 'body' => "hello {$user->name}  {$user->lastName} is in the class"]);
    }
}
