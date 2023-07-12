<?php

namespace App\Http\Middleware;

use App\Utils\Common\UserRoles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role != UserRoles::ADMIN && auth()->user()->role != UserRoles::SUPER_ADMIN){
            createFlashMessage('You are not authorized to access this page','danger');
            return redirect()->back();
        }
        return $next($request);
    }
}
