<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class BindUser
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
        $userId = $request->header('Authorization');
        if ($userId) {
            $user = User::firstOrCreate(['id' => $userId]);
            abort_unless($user, 404, "There's no user on your team with id `{$userId}`");

            $request->route()->setParameter('user', $user);
        } else {
            return errorResponse(['message' => 'Не авторизован'], 401);
        }

        return $next($request);
    }

}
