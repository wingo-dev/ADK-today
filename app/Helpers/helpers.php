<?php

use App\Models\BanUser;
use App\Utils\Common\UserRoles;

if (!function_exists('createFlashMessage')) {
    function createFlashMessage($message, $class = "info")
    {
        Illuminate\Support\Facades\Session::flash($class, $message);
    }
}

if (!function_exists('isBanned')) {
    function isBanned($user)
    {
        if ($user->role == UserRoles::VENDOR || $user->role == UserRoles::USER) {
            return BanUser::where('user_id',$user->id)->orWhere('ip_address',request()->ip())->exists();
            // return BanUser::where('email', $user->email)->orWhere('ip_address', request()->ip)->exists();
        }
        return false;
    }
}
