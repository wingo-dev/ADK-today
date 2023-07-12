<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\UpdateRequest;
use App\Utils\Common\UserRoles;
use App\Utils\Common\UserStatus;
use Illuminate\Http\Request;

class AccountSettingController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        return view('accounts.edit',compact('user'));

    }
    public function update(UpdateRequest $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $data = $request->validated();

        if(isset($data['password'])){
            $request->validate([
                'password' => 'confirmed|min:6|max:15'
            ]);
            $data['password'] = bcrypt($data['password']);
        }
        else{
            unset($data['password']);
        }

        if(isset($data['email']) && $data['email'] != $user->email){
            $data['email_verified_at'] = null;
            $data['status'] = UserStatus::UNVERIFIED;

        }

        $user->update($data);
        // $user->fresh()->sendEmailVerificationNotification();

        createFlashMessage('Profile Updated Successfully','success');
        
        if ($request->has('redirect')) {
            $uri = $request->input('redirect');
            return redirect($uri);
        }
        
        if($user->role == UserRoles::USER){
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function destroy()
    {
        $user = auth()->user();
        $user->delete();
        createFlashMessage('Account Deleted Successfully','success');
        return route('login');
    }
    public function editProfile()
    {
        $user = auth()->user();
        return view('profile-edit',compact('user'));
    }
    public function settings()
    {
        $user = auth()->user();
        return view('accounts.settings', compact('user'));
    }
    public function updateSettings(Request $request)
    {
        // dd($request);
        return redirect()->back();
    }
    public function upgradeToVendor()
    {
        $user = auth()->user();
        $user->update([
            'role' => UserRoles::VENDOR
        ]);
        // createFlashMessage('Updated successfully','success');
        return route('dashboard');
    }
}
