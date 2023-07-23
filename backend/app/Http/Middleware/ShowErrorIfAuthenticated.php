<?php

namespace App\Http\Middleware;

use App\Http\Response\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowErrorIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (\Auth::check()) {
            return ApiResponse::forbidden();
        }
        return $next($request);
    }
}
