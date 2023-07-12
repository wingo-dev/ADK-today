@extends('layouts.master')
@section('page-title', 'User Profile Settings')

@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">User Profile Settings</h4>
                </div>
                <div class="card-body py-2 my-25">
                    <form class="validate-form" method="post" action="{{route('update-account-settings', $user->id)}}" id="account-form">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            @include('accounts.setting-form-fields')
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-1 me-1">OK</button>
                            </div>
                        </div>
                    </form>
                    <!--/ form -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
@endsection
