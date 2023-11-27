<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Cashier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guest()) {
            return redirect()->route('login'); // Adjust 'login' to the name or route of your login page
        }
        
        if(auth()->check() && auth()->user()->isCashier())
            return $next($request);
        abort(403, 'Unauthorized');

    }
}
