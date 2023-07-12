<?php

namespace App\Http\Middleware;

use App\Utils\Common\UserRoles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isVendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if ($user->role != UserRoles::ADMIN && $user->role != UserRoles::SUPER_ADMIN && $user->role != UserRoles::VENDOR) {
            createFlashMessage('You are not authorized to access this page', 'danger');
            return redirect()->back();
        }
        // Vendor Profile Incomplete

        if ($user->role == UserRoles::VENDOR) {
            if (
                !isset($user->title) ||
                !isset($user->organization) ||
                !isset($user->phone) ||
                !isset($user->address1) ||
                !isset($user->town) ||
                !isset($user->county) ||
                !isset($user->zip)
            ) {
                createFlashMessage('Please complete your profile first', 'warning');
                return redirect()->route('profile-edit', ['redirect' => 'dashboard']);
            }
        }
        //
        return $next($request);
    }
}
