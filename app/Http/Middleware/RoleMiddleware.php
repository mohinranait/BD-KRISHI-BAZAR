<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Seller;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
            return back();
        }

        if($role == 'company')
        {
 
             if (! $request->user()->hasCompanyOf($request->company)) 
             {
                abort(401);
             }
        }         

        return $next($request);
    }
}
