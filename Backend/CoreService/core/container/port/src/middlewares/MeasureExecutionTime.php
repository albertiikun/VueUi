<?php

namespace Core\container\port\src\middlewares;

use Closure;

class MeasureExecutionTime
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
        // Get the response
        $response = $next($request);

        // Calculate execution time
        microtime(true) - LUMEN_START;

        return $response;
    }
}
