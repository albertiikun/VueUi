<?php

namespace Host\controllers;

use Host\controllers\base\Controller;
use Host\controllers\base\GuzzleHttp;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use GuzzleHttp;

    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('devApi.services.auth');
    }
    public function Login(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/oauth/token', $request);
    }

    public function Logout(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/oauth/logout', $request);
    }

    public function User(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/oauth/user', $request);
    }

    public function ForgotPassword(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/oauth/forgot-password', $request);
    }
    public function ResetPassword(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/oauth/reset-password', $request);
    }
}
