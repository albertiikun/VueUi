<?php

namespace Functional\own\queries\loggedIn;

use Core\myvendor\defaults\job\Job;
use Domain\Entities\LoginIpAddress;
use Domain\Entities\User;
use Illuminate\Support\Facades\Mail;

class LoggedInJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $_requestIp;
    private $_userId;
    private $_logInIpAddressModel;
    private $_client;
    private $_os;
    private $_userModel;
    private $_getIpInfo;

    public function __construct($requestIp, $user_id, $client, $os)
    {
        $this->_requestIp = $requestIp;
        $this->_userId = $user_id;
        $this->_client = $client;
        $this->_os = $os;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->_getIpInfo = geoip()->getLocation($this->_requestIp);
        $this->_logInIpAddressModel = new LoginIpAddress();

        $isLoggedInBefore = $this->_logInIpAddressModel::where('user_id', $this->_userId)
            ->where('ipAddress', $this->_requestIp)->count();

        if ($isLoggedInBefore != 0) {
            return;
        } else {
            $this->_logInIpAddressModel = new LoginIpAddress();
            $this->_logInIpAddressModel->user_id = $this->_userId;
            $this->_logInIpAddressModel->ipAddress = $this->_requestIp;
            if ($this->_client) {
                $this->_logInIpAddressModel->client_name = $this->_client['name'];
                $this->_logInIpAddressModel->client_type = $this->_client['type'];
                $this->_logInIpAddressModel->client_version = $this->_client['version'];
                $this->_logInIpAddressModel->client_engine = $this->_client['engine'];
                $this->_logInIpAddressModel->client_engine_version = $this->_client['engine_version'];
            }
            if ($this->_os) {
                $this->_logInIpAddressModel->os_name = $this->_os['name'];
                $this->_logInIpAddressModel->os_version = $this->_os['version'];
                $this->_logInIpAddressModel->os_platform = $this->_os['platform'];
            }
            if ($this->_getIpInfo) {
                $this->_logInIpAddressModel->iso_code = $this->_getIpInfo['iso_code'];
                $this->_logInIpAddressModel->country = $this->_getIpInfo['country'];
                $this->_logInIpAddressModel->city = $this->_getIpInfo['city'];
                $this->_logInIpAddressModel->lat = $this->_getIpInfo['lat'];
                $this->_logInIpAddressModel->lon = $this->_getIpInfo['lon'];
            }

            $this->_logInIpAddressModel->save();
            $this->_userModel = User::where('id', $this->_userId)->first();
            Mail::to($this->_userModel->email)->send(new LoggedInNotification($this->_requestIp, $this->_userModel, $this->_client, $this->_os, $this->_getIpInfo));
        }

    }
}
