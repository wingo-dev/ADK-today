@extends('layouts.master')
@section('page-title', 'Create County')

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
                <h2 class="content-header-title float-start mb-0">Categories</h2>
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
                        <h4 class="card-title">County Details</h4>
                    </div>
                    <div class="card-body py-2 my-25">

                        <form class="validate-form" method="post" action="{{isset($category) ? route('categories.update',$category->id) : route('categories.store')}}" enctype="multipart/form-data">
                            @csrf
                            @isset($category)
                                @method('PUT')
                            @endisset

                            <div class="row">
                                @include('categories.form-fields')
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-1 me-1">{{isset($category) ? 'Update' : 'Create'}}</button>
                                    <a href="{{route('categories.index')}}" class="btn btn-outline-secondary mt-1">Discard</a>
                                </div>
                            </div>
                        </form>
                        <!--/ form -->
                    </div>
                </div>
            </div>
        </div>
@endsection
