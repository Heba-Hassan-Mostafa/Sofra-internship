<?php

namespace App\Http\Middleware;

use Closure;

class CheckCommission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (($request->user()->total_commissions - $request->user()->total_payments) > 400)
        {
            return apiResponse(-1,'Your account has been temporarily suspended until the commission is paid to its maximum, please check the commission page or review the application management.');
        }
        return $next($request);
    }
}
