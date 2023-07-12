@extends('layouts.master')
@section('page-title', 'Create Event')

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
            <h2 class="content-header-title float-start mb-0">Events</h2>
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
                    <h4 class="card-title">Tag Recommendation</h4>
                </div>
                <div class="card-body py-2 my-25">

                    <form class="validate-form" method="post" action="{{route('tags.recommend')}}"
                        enctype="multipart/form-data">
                        @csrf


                        <div class="row">
                            <div class="col-md-4 col-sm-6 mb-1">
                                <label class="form-label" for="category_id">Category</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-1">
                                <label class="form-label" for="name">Tag Name</label>
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    placeholder="Please enter Tag name" />
                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-primary mt-1 me-1">Suggest</button>
                                <a href="{{route('events.index')}}" class="btn btn-outline-secondary mt-1">Discard</a>
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
