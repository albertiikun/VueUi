<?php

namespace Host\controllers;

use Functional\user\commands\delete\DeleteHandler;
use Functional\user\commands\deletePermanently\DeletePermanentlyHandler;
use Functional\user\commands\register\RegisterHandler;
use Functional\user\commands\setUserIpRestriction\SetUserIpRestrictionHandler;
use Functional\user\commands\undelete\UndeleteHandler;
use Functional\user\commands\updatePassword\UpdatePasswordHandler;
use Functional\user\commands\update\UpdateHandler;
use Functional\user\commands\updateUsernameAndEmail\UpdateUsernameAndEmailHandler;
use Functional\user\queries\checkEmailExist\CheckEmailExistHandler;
use Functional\user\queries\checkUsernameExist\CheckUsernameExistHandler;
use Functional\user\queries\getAll\GetAllHandler;
use Functional\user\queries\getById\GetByIdHandler;
use Functional\user\queries\getDeletedById\GetDeletedByIdHandler;
use Functional\user\queries\getDeleted\GetDeletedHandler;
use Functional\user\queries\getUsernameAndEmailById\GetUsernameAndEmailByIdHandler;
use Host\controllers\base\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Register(RegisterHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function UpdatePassword(UpdatePasswordHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function Update(UpdateHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function Delete(DeleteHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function Get(GetAllHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function GetById(GetByIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function GetDeleted(GetDeletedHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function GetDeletedById(GetDeletedByIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function Undelete(UndeleteHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function SetUserIpRestriction(SetUserIpRestrictionHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function CheckEmailExist(CheckEmailExistHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function CheckUsernameExist(CheckUsernameExistHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }

    public function DeletePermanently(DeletePermanentlyHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function UpdateUsernameAndEmail(UpdateUsernameAndEmailHandler $command, Request $request)
    {
        return $this->_meteor->Send($command, $request);
    }

    public function GetUsernameAndEmailById(GetUsernameAndEmailByIdHandler $query, Request $request)
    {
        return $this->_meteor->Send($query, $request);
    }
}
