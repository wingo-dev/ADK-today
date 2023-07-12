@extends('layouts.front_end.master')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-md-8">


            <div class="card">

                <div class="card-header">

                    <div id="avatar-large">
                        <!--<h3 class="text-center">{{auth()->user()->name}}</h3>-->
                        <h3 class="text-center">Profile</h3>
                    </div>

                </div>



                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <a href="{{route('profile-edit')}}" class="btn btn-primary mt-2" style="width:100%">Edit Profile</a>
                        </div>
                        <div class="col-sm-6 text-center">
                            <a href="{{route('password-change')}}" class="btn btn-secondary mt-2" style="width:100%">Change Password</a>
                        </div>
                        
                        @if(auth()->user()->role == \App\Utils\Common\UserRoles::VENDOR || auth()->user()->role == \App\Utils\Common\UserRoles::USER)
                        <div class="col-sm-6 text-center">
                            <button type="button" onclick="deleteByID('{{route('delete-account')}}')" class="btn btn-danger w-100 mt-2">Delete Account</button>
                        </div>
                        <div class="col-sm-6 text-center">
                            <a href="{{route('account-settings')}}" class="btn btn-success mt-2" style="width:100%">Settings</a>
                        </div>
                        @endif
                        
                        @if(auth()->user()->role == \App\Utils\Common\UserRoles::USER)
                        <div class="col-sm-6 text-center">
                            <button type="button" onclick="upgradeToVendor('{{route('upgrade-vendor')}}')" class="btn btn-info w-100 mt-2">Submit Event</button>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection
