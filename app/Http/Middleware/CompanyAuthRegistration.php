<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CompanyAuthRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error'  => 'Unauthorized Access',
                    'messgae' => 'You need to be logged in to proceed'
                ], Response::HTTP_UNAUTHORIZED)->header('Content-Type', 'application/json');
            } else {
                return redirect()->route('login');
            }
        }

        if ( empty(Auth::user()->userCompanies()) ) {
            return redirect()->route('register.companies');
        }

        return $next($request);
    }
}
