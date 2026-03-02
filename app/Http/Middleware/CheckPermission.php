<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permiso)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        if (!auth()->user()->hasPermission($permiso)) {
            abort(403, 'No tienes autorización para acceder aquí');
        }

        return $next($request);
    }
}