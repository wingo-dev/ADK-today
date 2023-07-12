<?php

namespace App\Http\Middleware;

use App\Models\BanUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isBannedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if($user && isBanned($user)){
            createFlashMessage("You are banned", "danger");
            Auth::logout();
            return redirect()->route('login');
        }
        return $next($request);
    }
}
