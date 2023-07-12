<?php

namespace App\Http\Controllers;

use App\Models\BanUser;
use App\Models\User;
use App\Utils\Common\UserRoles;
use App\Utils\Common\UserStatus;
use App\Utils\Helpers;
use Illuminate\Http\Request;

class BanController extends Controller
{

    public function index()
    {
        $ban_users = BanUser::pluck('user_id');
        $ban_users = User::whereIn('id', $ban_users)->paginate(10);
        return view('ban-users.index', compact('ban_users'));
    }
    public function create()
    {
        $auth_user = auth()->user();
        if ($auth_user->role == UserRoles::ADMIN) {
            $users = User::whereNot('id', $auth_user->id)->where('role', '!=', UserRoles::SUPER_ADMIN)->where('role', '!=', UserRoles::ADMIN)->paginate(10);
        } else {
            $users = User::whereNot('id', $auth_user->id)->paginate(10);
        }
        return view('ban-users.create', compact('users'));
    }
    public function banUser(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            BanUser::create(['user_id' => $user->id,'ip_address' => $user->ip_address]);
            $user->update(['status' => UserStatus::BLOCKED]);
            createFlashMessage('User Banned Successfully', 'success');
        } else {
            createFlashMessage('User Not Found', 'danger');
        }
        if ($request->ajax()) {
            return url()->previous();
        }
        return redirect()->route('ban-users.index');
    }

    public function unbanUser(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            BanUser::where('user_id', $user->id)->orWhere('ip_address',$user->ip_address)->delete();
            $user->update(['status' => $user->email_verified_at != null ? UserStatus::VERIFIED : UserStatus::UNVERIFIED]);
            createFlashMessage('User UnBanned Successfully', 'success');
        } else {
            createFlashMessage('User Not Found', 'danger');
        }
        if ($request->ajax()) {
            return url()->previous();
        }
        return redirect()->route('ban-users.index');
    }
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string'
        ]);
        $ban_users       = BanUser::pluck('user_id');
        $query           = User::query()->whereIn('id', $ban_users);
        $data            = $request->all();
        $ban_users       = Helpers::usersFilter($query, $request->search, $data);
        return view('ban-users.index', compact('ban_users'));
    }
}
