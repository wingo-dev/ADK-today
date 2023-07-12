<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Jobs\SendEmailJob;
use App\Models\User;
use App\Utils\Common\UserRoles;
use App\Utils\Common\UserStatus;
use App\Utils\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth_user = auth()->user();
        if ($auth_user->role == UserRoles::SUPER_ADMIN)
            $users = User::whereNot('id', $auth_user->id)->paginate(10);
        else if ($auth_user->role == UserRoles::ADMIN) {
            $users = User::whereNot('id', $auth_user->id)->where('role', '!=', UserRoles::SUPER_ADMIN)->where('role', '!=', UserRoles::ADMIN)->paginate(10);
        } else {
            createFlashMessage('You can not access this page', 'danger');
            return redirect()->back();
        }
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $auth_user = auth()->user();

        if ($auth_user->role != UserRoles::ADMIN && $auth_user->role != UserRoles::SUPER_ADMIN) {
            createFlashMessage('You can not create user', 'danger');
            return redirect()->back();
        }

        if ($data['role'] == UserRoles::SUPER_ADMIN) {
            createFlashMessage('You can not create another super admin', 'danger');
            return redirect()->back();
        }

        if ($auth_user->role != UserRoles::SUPER_ADMIN && $data['role'] == UserRoles::ADMIN) {
            createFlashMessage('You can not create admin', 'danger');
            return redirect()->back();
        }

        if (isset($data['password'])) {
            $request->validate([
                'password' => 'required|confirmed|min:6|max:15',
            ]);
            $password = $data['password'];
            $data['password'] = bcrypt($data['password']);
        }else{
            $password = Str::random(8);
            $data['password'] = Hash::make($password);
        }
        
        if ( isset($data['g-recaptcha-response']) ) {
            unset($data['g-recaptcha-response']);
        }
        
        $data['status'] = UserStatus::VERIFIED;
        $data['email_verified_at'] = now();
        $user = User::create($data);
        createFlashMessage('User Created Successfully', 'success');

        if($user->role == UserRoles::ADMIN){
            $details = [
                'email' => $user->email,
                'password' => $password,
                'role' => UserRoles::ALL[$user->role],
                'type' => 'admin-account-creation',
            ];
            dispatch(new SendEmailJob($details));
            // Mail::send("emails.admin-account-create-notification", ['email' => $user->email,'password'=> $password], function ($message) use ($user) {
            //     $message->to($user->email);
            //     $message->subject("Your Administrative Account Details");
            // });
        }else{
                $details = [
                    'email' => $user->email,
                    'password' => $password,
                    'role' => UserRoles::ALL[$user->role],
                    'type' => 'user-account-creation',
                ];
                dispatch(new SendEmailJob($details));
            // Mail::send("emails.user-account-create-notification", ['email' => $user->email,'password'=> $password,'role' => UserRoles::ALL[$user->role]], function ($message) use ($user) {
            //     $message->to($user->email);
            //     $message->subject("Your Account Details");
            // });
        }
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();
        $auth_user = auth()->user();
        if ($auth_user->role != UserRoles::ADMIN && $auth_user->role != UserRoles::SUPER_ADMIN) {
            createFlashMessage('You can not create user', 'danger');
            return redirect()->back();
        }

        if ($data['role'] == UserRoles::SUPER_ADMIN) {
            createFlashMessage('You can not create another super admin', 'danger');
            return redirect()->back();
        }

        if ($auth_user->role != UserRoles::SUPER_ADMIN && $data['role'] == UserRoles::ADMIN) {
            createFlashMessage('You can not create admin', 'danger');
            return redirect()->back();
        }
        if (isset($data['password'])) {
            $request->validate([
                'password' => 'required|confirmed|min:6|max:15'
            ]);
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        if(isset($data['is_verified'])){
            $data['status'] = UserStatus::VERIFIED;
            $data['email_verified_at'] = now();
            $details = ['type' => 'email-verification','email' => $user->email];
            dispatch(new SendEmailJob($details));

        }else{
            $data['status'] = UserStatus::UNVERIFIED;
            $data['email_verified_at'] = null;
        }

        unset($data['is_verified']);


        $user->update($data);
        createFlashMessage('User Updated Successfully', 'success');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        createFlashMessage('User Deleted Successfully', 'success');
        return route('users.index');
    }
    public function verificationView()
    {
        $email = request()->session()->pull('email_verification', '');
        return view('verification', compact('email'));
    }
    public function verificationResend(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user) {

            $user->sendEmailVerificationNotification();
            session(['email_verification' => $user->email]);
        }


        createFlashMessage('Verification email sent successfully', 'success');
        return redirect()->route('verification.view');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string'
        ]);
        $query           = User::query();
        $data            = $request->all();
        $users           = Helpers::usersFilter($query, $request->search,$data);
        return view('users.index', compact('users'));
    }
}
