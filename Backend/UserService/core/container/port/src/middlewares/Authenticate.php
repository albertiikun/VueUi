<?php

namespace Core\container\port\src\middlewares;

use Closure;
use Core\myvendor\common\Exceptions\UnauthorizedException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */

    protected $accessUri;
    protected $serviceLoginUri;
    protected $serviceLoginSecretKey;
    protected $serviceLoginClientId;
    protected $serviceLoginScope;
    protected $tries = 0;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct()
    {
        $this->accessUri = config('services.access.uri');
        $this->serviceLoginUri = config('services.service-login.uri');
        $this->serviceLoginSecretKey = config('services.service-login.client-secret');
        $this->serviceLoginClientId = config('services.service-login.client-id');
        $this->serviceLoginScope = config('services.service-login.scope');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $client = new Client([
            'http_errors' => false,
        ]);

        $this->access($client, $request);
        if (AUTH_USER_ID == null) {
            throw new UnauthorizedException();
        } else {
            return $next($request);
        }
    }

    public function access($client, $request)
    {
        try {
            $serviceToken = Storage::get('token.key');

            $userToken = $request->bearerToken();

            $client = new Client([
                'http_errors' => false,
            ]);

            $result = $client->getAsync($this->accessUri, ['headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer' . ' ' . $serviceToken,
                'user-authorization' => 'Bearer' . ' ' . $userToken,
            ]])->then(
                function ($response) {
                    return $response->getBody();
                },
                function ($e) {
                    echo $e;
                }
            );
            $data = $result->wait();

            $userId = json_decode($data, true)['id'];

            define('AUTH_USER_ID', $userId);
        } catch (\Throwable $th) {
            $this->loginService($client);
            $this->tries++;
            if ($this->tries > 1) {
                throw new UnauthorizedException();
            } else {
                $this->access($client, $request);
            }
        }
    }

    private function loginService($client)
    {
        try {
            $result = $client->postAsync($this->serviceLoginUri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'grant_type' => 'client_credentials',
                    'scope' => $this->serviceLoginScope,
                    'client_secret' => $this->serviceLoginSecretKey,
                    'client_id' => $this->serviceLoginClientId,
                ],
            ])->then(function ($response) {
                return $response->getBody();
            });

            $data = $result->wait();

            $token = json_decode($data, true)['access_token'];

            Storage::put('token.key', $token);
        } catch (\Throwable $th) {
            throw new UnauthorizedException();
        }
    }
}
