@extends('layouts.master')
@section('page-title', 'Tags')
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
    <a href="{{route('tags.create')}}" class="btn btn-relief-outline-primary waves-effect waves-float waves-light">
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
                    <div class="col-sm-2"><h2>Tags</h2></div>
                    <form class="col-sm-10" action="{{route('tags.search')}}" method="get">
                        <div class="row d-flex justify-content-end">
                            {{-- filter stars --}}


                            {{-- filter ends --}}

                            <div class="btn-group  col-sm-6 ">

                                <label for="status" class="form-label  "
                                style="margin-right: 10px; margin-top:0.5rem ; font-weight: bolder">Category:</label>
                                <select class="form-control rounded" placeholder="Search" name="category_id" style="border-radius: 5px">
                                    <option value="">Any</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{isset(request()->category_id) && request()->category_id == $category->id ? "Selected" : ""}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
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
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @forelse ($tags as $tag)
                        <tr>
                            <td>{{$tag->name}}</td>

                            <td>
                                <a href="{{route('tags.show', $tag->id)}}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Show"><i
                                        data-feather="eye"></i></a>
                                <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i
                                        data-feather="edit"></i></a>
                                <a href="javascript:void(0);"
                                    onclick="deleteByID('{{route('tags.destroy', $tag->id)}}','Tag')"
                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i data-feather="trash"></i></a>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $tags->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
