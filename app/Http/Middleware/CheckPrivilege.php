<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckPrivilege
{
    public function handle(Request $request, Closure $next, $privilege)
    {
        $user = $request->user();
        
        if (!$user || !$user->hasPrivilege(constant("App\Models\User::$privilege"))) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}