@extends('layouts.master')
@section('page-title', 'Create User')

@section('page-vendor')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-11">
            <h2 class="content-header-title float-start mb-0">Banned Users</h2>
            {{-- <div class="breadcrumb-wrapper">
                {{Breadcrumbs::render('user.create') }}
            </div> --}}
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Banned User Details</h4>
                </div>
                <div class="card-body py-2 my-25">

                    <form class="validate-form" method="post" action="{{route('ban-users.ban')}}"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            {{-- here goes the field --}}
                            <div class="col-md-4 col-sm-6 mb-1">
                                <label class="form-label" for="role">User</label>
                                <select name="user_id" class="form-control" id="">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- end fields --}}
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-1 me-1">Ban</button>
                                <a href="{{route('ban-users.index')}}"
                                    class="btn btn-outline-secondary mt-1">Discard</a>
                            </div>
                        </div>
                    </form>
                    <!--/ form -->
                </div>
            </div>
        </div>
    </div>
    @endsection
