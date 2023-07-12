<?php

namespace App\Http\Middleware;

use App\Utils\Common\UserRoles;
use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyOutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user && ($user->role == UserRoles::VENDOR || $user->role == UserRoles::USER) && $user->email_verified_at == null) {
            $email = $user->email;
            Auth::logout();
            session(['email_verification' => $email]);


            // return redirect()->route('verification.view');
            return redirect()->route('verification.modal.resend', ['email' => $email]);
        }
        return $next($request);
    }
}
