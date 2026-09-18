<?php
namespace App\Features\Auth\Middleware;
use Closure;
use Illuminate\Http\Request;

// ponytail: basic role check based on user role column; add granular permissions when complex ACL is required.
class RoleMiddleware {
    public function handle(Request $request, Closure $next, ...$roles) {
        if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
            abort(403, 'Akses Ditolak');
        }
        return $next($request);
    }
}
