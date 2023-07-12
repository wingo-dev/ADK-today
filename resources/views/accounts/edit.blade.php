@extends('layouts.master')
@section('page-title', 'Edit Account')


@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Account Details</h4>
                </div>
                <div class="card-body py-2 my-25">

                    <form class="validate-form" method="post" action="{{route('update-account', $user->id)}}" id="account-form">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            @include('accounts.form-fields')
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-1 me-1">Update</button>
                                <button type="button" onclick="deleteByID('{{route('delete-account')}}')" class="btn btn-danger mt-1">Delete</button>
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
