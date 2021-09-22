<?php

namespace App\Http\Middleware\api;

use App\Traits\ApiResponser;
use Closure;
use Illuminate\Http\Request;

class IsActive
{
    use ApiResponser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->active != '1'){
            return $this->error('Your account has not been activated!', 400, null);
        }
        return $next($request);
    }
}
