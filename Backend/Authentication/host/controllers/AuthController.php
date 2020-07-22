<?php

namespace Host\Controllers;

use Functional\own\commands\ConfirmEmail\ConfirmEmailHandler;
use Functional\own\commands\LogoutAllDevices\LogoutAllDevicesHandler;
use Functional\own\commands\Logout\LogoutHandler;
use Functional\own\commands\ResetPassword\ResetPasswordHandler;
use Functional\own\queries\access\AccessHandler;
use Functional\own\queries\checkAuth\CheckAuthHandler;
use Functional\own\queries\forgotPassword\ForgotPasswordHandler;
use Functional\own\queries\loggedIn\LoggedInHandler;
use Functional\own\queries\requestConfirmEmail\RequestConfirmEmailHandler;
use Host\controllers\base\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function CheckAuth(CheckAuthHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function Access(AccessHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function Logout(LogoutHandler $command)
    {
        return $this->_meteor->Send($command);
    }

    public function LogoutAllDevices(LogoutAllDevicesHandler $command)
    {
        return $this->_meteor->Send($command);
    }

    public function ForgotPassword(ForgotPasswordHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function ResetPassword(ResetPasswordHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function RequestConfirmEmail(RequestConfirmEmailHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function ConfirmEmail(ConfirmEmailHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function LoggedIn(LoggedInHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function User()
    {
        return Auth::user();
    }

}
