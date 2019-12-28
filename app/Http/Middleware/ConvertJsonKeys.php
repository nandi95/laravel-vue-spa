<?php

namespace App\Core\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ConvertJsonKeys
 *
 * @package App\Http\Middleware
 */
class ConvertJsonKeys
{
    /**
     * Handle the middleware
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Convert input data keys to snake case
        $request->replace(snake_array_keys($request->all()));

        // Convert response data keys to camel case
        if (($response = $next($request)) instanceof JsonResponse) {
            $response->setData(camel_array_keys($response->getData(true)));
        }

        return $response;
    }
}
