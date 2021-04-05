<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Traits\GeneralTraits;

class CheckAdminToken
{
    use GeneralTraits ;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = null ;
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }
        catch(\Exception $ex)
        {
            if($ex instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return $this->returnError('E_3001','TOKEN_INVALIED');
            }
            else if ($ex instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return $this->returnError('E_3001','TOKEN_EXPIRED');
            }
            else
            {
                return $this->returnError('E_3001','TOKEN_NOT_FOUND');
            }
        }

        catch(\Throwable $ex)
        {
            if($ex instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException)
            {
                return $this->returnError('E_3001','TOKEN_INVALIED');
            }
            else if ($ex instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException)
            {
                return $this->returnError('E_3001','TOKEN_EXPIRED');
            }
            else
            {
                return $this->returnError('E_3001','TOKEN_NOT_FOUND');
            }
        }

        if(!$user)
        {
            return $this->returnError('E_3002','UNEUTHEN');
        }

        return $next($request);
    }
}
