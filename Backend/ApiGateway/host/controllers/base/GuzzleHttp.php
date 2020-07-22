<?php

namespace Host\controllers\base;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

trait GuzzleHttp
{
    public function httpPost($baseUrl, $requestUrl, Request $request)
    {

        $client = new Client([
            'http_errors' => false,
        ]);

        if ($request->all() != null) {
            $data = $this->PostWithData($client, $baseUrl, $requestUrl, $request);
        } else {
            $data = $this->PostWithoutData($client, $baseUrl, $requestUrl, $request);
        }

        return $data;
    }

    public function httpPut($baseUrl, $requestUrl, Request $request)
    {

        $client = new Client([
            'http_errors' => false,
        ]);

        $data = $this->PutData($client, $baseUrl, $requestUrl, $request);

        return $data;
    }

    public function httpDelete($baseUrl, $requestUrl, Request $request)
    {

        $client = new Client([
            'http_errors' => false,
        ]);

        $data = $this->DeleteData($client, $baseUrl, $requestUrl, $request);

        return $data;
    }

    public function httpGet($baseUrl, $requestUrl, Request $request)
    {
        $client = new Client([
            'http_errors' => false,
        ]);

        $result = $client->getAsync($baseUrl . $requestUrl, [
            'headers' => $request->header(),
            'query' => $request->all(),
        ])->then(function ($response) {
            return response($response->getBody(), $response->getStatusCode());
        });

        $data = $result->wait();

        return $data;
    }

    public function PostWithData($client, $baseUrl, $requestUrl, Request $request)
    {
        $result = $client->postAsync($baseUrl . $requestUrl, [
            'headers' => $request->header(),
            'json' => $request->all(),
        ])->then(function ($response) {
            return response($response->getBody(), $response->getStatusCode());
        });

        return $result->wait();
    }

    public function PostWithoutData($client, $baseUrl, $requestUrl, Request $request)
    {
        $result = $client->postAsync($baseUrl . $requestUrl, [
            'headers' => $request->header(),
        ])->then(function ($response) {
            return response($response->getBody(), $response->getStatusCode());
        });

        return $result->wait();
    }

    public function PutData($client, $baseUrl, $requestUrl, Request $request)
    {
        $result = $client->putAsync($baseUrl . $requestUrl, [
            'headers' => $request->header(),
            'json' => $request->all(),
        ])->then(function ($response) {
            return response($response->getBody(), $response->getStatusCode());
        });

        return $result->wait();
    }

    public function DeleteData($client, $baseUrl, $requestUrl, Request $request)
    {
        $result = $client->deleteAsync($baseUrl . $requestUrl, [
            'headers' => $request->header(),
            'json' => $request->all(),
        ])->then(function ($response) {
            return response($response->getBody(), $response->getStatusCode());
        });

        return $result->wait();
    }
}
