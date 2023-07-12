@extends('layouts.master')
@section('page-title', 'Categories')
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
    <a href="{{route('categories.create')}}" class="btn btn-relief-outline-primary waves-effect waves-float waves-light">
        Add
    </a>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"><h2>Categories</h2></div>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <th>name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>
                                <a href="{{route('categories.show', $category->id)}}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Show"><i
                                        data-feather="eye"></i></a>
                                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                        data-feather="edit"></i></a>

                                <a href="javascript:void(0);" onclick="deleteByID('{{route('categories.destroy', $category->id)}}','Category')" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i data-feather="trash"></i></a>

                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $categories->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
