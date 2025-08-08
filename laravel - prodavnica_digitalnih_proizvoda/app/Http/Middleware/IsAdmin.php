<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $u = $request->user();
        if (! $u || $u->role !== 'admin') {
            return response()->json(['message' => 'Zabranjen pristup'], 403);
        }
        return $next($request);
    }
}
