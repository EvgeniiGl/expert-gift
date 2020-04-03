<?php

namespace App\Http\Middleware;

use Closure;

class IP
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!in_array($request->ip(), config('admin_ip.ips'))) {
            return errorResponse(['message' => "Доступ по этому IP запрещен!"], 401);
        }

        return $next($request);
    }
}
