<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPassword
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
        if ($request->api_password != env('API_PASSWORD','2172000')) // api_password we was written in postman
        {
            return response()->json(['messasge'=> 'not auth']);
        }
        return $next($request);
    }
}
