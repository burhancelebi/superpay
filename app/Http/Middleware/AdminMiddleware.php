<?php

namespace App\Http\Middleware;

use App\Enums\Users\UserRoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->role !== UserRoleEnum::ADMIN->value) {
            Auth::logout();
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
