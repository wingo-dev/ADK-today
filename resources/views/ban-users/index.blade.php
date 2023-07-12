@extends('layouts.master')
@section('page-title', 'Users')
@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    {{-- <div class="row breadcrumbs-top">
        <div class="col-11">
            <h2 class="content-header-title float-start mb-0">{{__('lang.fields.question-bank.plural')}}</h2>
            <div class="breadcrumb-wrapper">
                {{Breadcrumbs::render('question-bank.index')}}
            </div>
        </div>
    </div> --}}
</div>
<div class="mb-1 text-end">
    <a href="{{route('ban-users.create')}}" class="btn btn-relief-outline-primary waves-effect waves-float waves-light">
        Add
    </a>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header row">
                <div class="row" style="align-items: center">
                    <div class="col-sm-2"><h2>Banned Users</h2></div>
                    <form class="col-sm-10" action="{{route('ban-users.search')}}" method="get">
                        <div class="row d-flex justify-content-end">
                            {{-- filter stars --}}
                            <div class=" col-sm-3 d-flex " style="width: inherit; align-items: center;">
                                <label for="status" class="form-label  "
                                    style="margin-right: 5px ; font-weight: bolder">Status:</label>
                                <select class="form-select" data-minimum-results-for-search="Infinity" name="status"
                                    id="status">
                                    <option value="">Any</option>
                                    @foreach(\App\Utils\Common\UserStatus::ALL as $key => $status)
                                    <option value="{{$key}}" {{isset(request()->status) && request()->status == $key ?
                                        "Selected" : ""}}>{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-sm-3 d-flex" style="width: inherit; align-items: center">
                                <label for="role" class="form-label  "
                                    style="margin-right: 5px ; font-weight: bolder">Role:</label>
                                <select class="form-select" data-minimum-results-for-search="Infinity" name="role"
                                    id="role">
                                    <option value="">Any</option>
                                    @foreach(\App\Utils\Common\UserRoles::ALL as $key => $role)
                                    <option value="{{$key}}" {{isset(request()->role) && request()->role == $key ?
                                        "Selected" : ""}}>{{$role}}</option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- filter ends --}}



                            <div class="btn-group  col-sm-6 ">


                                <input type="search" class="form-control rounded" placeholder="Search"
                                    aria-label="Search" aria-describedby="search-addon" name="search"
                                    value="{{isset(request()->search) ? request()->search : ''}}"
                                    style="border-radius: 5px" />
                                <button type="submit" class="btn btn-outline-primary" style="background: blue"> <i
                                        class="fa fa-search" aria-hidden="true"
                                        style="color: white; font-size: 12px"></i>
                                </button>

                            </div>

                        </div>
                    </form>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Ip Address</th>
                        <th>Last Login</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($ban_users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{\App\Utils\Common\UserRoles::ALL[$user->role]}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->ban->ip_address}}</td>
                            <td>{{$user->last_login}}</td>
                            <td>{{\App\Utils\Common\UserStatus::ALL[$user->status]}}</td>
                            <td>

                                <a href="javascript:void(0);" onclick="unbanByID('{{route('ban-users.unban')}}',{{$user->id}})" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Unban"><i data-feather="unban"></i></a>

                                {{-- @if(isBanned($user))
                                <a href="javascript:void(0);" onclick="banByID('{{route('users.ban',$user->id)}}')" class="btn btn-success btn-sm"><i data-feather="unlock"></i></a>
                                @else
                                <a href="javascript:void(0);" onclick="banByID('{{route('users.ban',$user->id)}}')" class="btn btn-danger btn-sm"><i data-feather="lock"></i></a>
                                @endif --}}
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $ban_users->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
