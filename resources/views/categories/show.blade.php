@extends('layouts.master')
@section('page-title', 'Show County')


@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Category Details</h4>
                </div>
                <div class="card-body py-2 my-25">

                        <div class="row">
                            @include('categories.show-fields')
                            <div class="col-12">
                                <a href="{{route('categories.index')}}" class="btn btn-outline-secondary mt-1">Discard</a>
                            </div>
                        </div>
                    <!--/ form -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')

@endsection
