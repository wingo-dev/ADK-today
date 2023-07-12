@extends('layouts.master')
@section('page-title', 'Events')
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
    @if(auth()->user()->role == \App\Utils\Common\UserRoles::VENDOR)
    <a href="{{route('categories.recommend.view')}}" class="btn btn-relief-outline-primary waves-effect waves-float waves-light">
        Suggest Category
    </a>
    <a href="{{route('tags.recommend.view')}}" class="btn btn-relief-outline-primary waves-effect waves-float waves-light">
        Suggest Tag
    </a>
    <a href="{{route('events.create')}}" class="btn btn-relief-outline-primary waves-effect waves-float waves-light">
        Add
    </a>
    @endif
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="col-12 row">
                    <h2>Events</h2>
                </div>
                
                @if(auth()->user()->role == \App\Utils\Common\UserRoles::SUPER_ADMIN || auth()->user()->role == \App\Utils\Common\UserRoles::ADMIN)
                <form class="col-12 row align-items-end" action="{{ route('events.index') }}" method="get">
                    <div class="col-md-3 mb-2">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="search" value="{{request()->search}}">
                    </div>
                    
                    <div class="col-md-2 mb-2">
                        <label for="startDate" class="form-label">Start Date:</label>
                        <input type="date" class="form-control" id="startDate" name="start_date" value="{{request()->start_date}}">
                    </div>
                    
                    <div class="col-md-2 mb-2">
                        <label for="endDate" class="form-label">End Date:</label>
                        <input type="date" class="form-control" id="endDate" name="end_date" value="{{request()->end_date}}">
                    </div>
                    
                    <div class="col-md-2 mb-2">
                        <label for="county_id" class="form-label">County</label>
                        <select class="form-select" aria-label="county" name="county_id" id="county_id">
                            <option value="">All Counties</option>
                            @foreach ($counties as $county)
                            <option value="{{$county->id}}" {{$county->id == request()->county_id ? "selected" : ""}}>{{$county->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-2 mb-2">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" aria-label="category" name="category_id" id="category_id">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == request()->category_id ? "selected" : ""}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-1 mb-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                @endif
                
            </div>
            
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>County</th>
                        <th>Town</th>
                        <th>Category</th>
                        @if(auth()->user()->role == \App\Utils\Common\UserRoles::SUPER_ADMIN || auth()->user()->role == \App\Utils\Common\UserRoles::ADMIN)
                        <th>Vendor</th>
                        @endif
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                        <tr>
                            <td>{{$event->title}}</td>
                            <td>{{ date('m/d/Y', strtotime($event->start_date)) }}</td>
                            <td>{{ date('m/d/Y', strtotime($event->end_date)) }}</td>
                            <td>{{$event->county->name}}</td>
                            <td>{{$event->town->name}}</td>
                            <td>{{$event->category->name}}</td>
                            @if(auth()->user()->role == \App\Utils\Common\UserRoles::SUPER_ADMIN || auth()->user()->role == \App\Utils\Common\UserRoles::ADMIN)
                            <td>{{$event->vendor->name}}</td>
                            @endif
                            <td>
                                <a href="{{route('events.show', $event->id)}}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Show"><i data-feather="eye"></i></a>
                                <a href="{{route('events.edit', $event->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i data-feather="edit"></i></a>
                                @if(auth()->user()->role == \App\Utils\Common\UserRoles::VENDOR)
                                <a href="{{route('clone-event', ['id' => $event->id])}}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Clone"><i data-feather="copy"></i></a>
                                @endif
                                <a href="javascript:void(0);" onclick="deleteByID('{{route('events.destroy', $event->id)}}','Event')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i data-feather="trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $events->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
