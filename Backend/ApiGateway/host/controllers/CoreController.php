<?php

namespace Host\controllers;

use Host\controllers\base\Controller;
use Host\controllers\base\GuzzleHttp;
use Illuminate\Http\Request;

class CoreController extends Controller
{
    use GuzzleHttp;

    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('devApi.services.core');
    }
    public function GetGenders(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/gender/', $request);
    }

    public function GetCities(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/city/', $request);
    }

    public function GetCountryById(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/country/:id', $request);
    }
    public function GetCountryByCityId(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/country/:cityId', $request);
    }

    public function GetEvents(Request $request)
    {
        return $this->httpGet($this->baseUrl, 'api/events/', $request);
    }

    public function CreateEvent(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/events/:create', $request);
    }

    public function EditEvent(Request $request)
    {
        return $this->httpPost($this->baseUrl, 'api/events/:edit', $request);
    }

    public function DeleteEvent(Request $request)
    {
        return $this->httpDelete($this->baseUrl, 'api/events/:delete', $request);
    }
}
