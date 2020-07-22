<?php

namespace Core\container\port\src\middlewares;

use Closure;
use DeviceDetector\DeviceDetector;
use Functional\Common\Exceptions\GuestIsBotException;

class GuardService
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userAgent = $request->userAgent();
        $dd = new DeviceDetector($userAgent);
        $dd->parse();
        if ($dd->isBot()) {
            throw new GuestIsBotException();
        }

        

        $response = $next($request);

        return $response;

    }

}
