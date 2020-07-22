<?php

namespace Core\container\port\src\middlewares;

use Closure;
use Core\myvendor\common\Exceptions\ThisIpIsRestrictedException;
use Core\myvendor\functions\auth\ThisAuth;
use Domain\entities\UserIpRestriction;

class IpRestrictionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ipAddresses = UserIpRestriction::where('user_id', ThisAuth::Id())->pluck('ipAddress');

        if (count($ipAddresses) == 0) {
            return $next($request);
        } else {
            foreach ($ipAddresses as $ipAddress) {
                if (strpos($request->ip(), $ipAddress) !== false) {
                    throw new ThisIpIsRestrictedException();
                }
            }
        }
        return $next($request);
        
    }
}
