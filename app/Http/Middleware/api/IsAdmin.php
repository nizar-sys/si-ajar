<?php

namespace App\Http\Middleware\api;

use App\Traits\ApiResponser;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        if($request->user()->role != '1'){
            return $this->error('Access denied!', 400, null);
        }
        return $next($request);
    }
}
