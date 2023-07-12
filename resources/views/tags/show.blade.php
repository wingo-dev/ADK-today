@extends('layouts.master')
@section('page-title', 'Show Tags')


@section('content')
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Town Details</h4>
                </div>
                <div class="card-body py-2 my-25">

                        <div class="row">
                            @include('tags.show-fields')
                            <div class="col-12">
                                <a href="{{route('tags.index')}}" class="btn btn-outline-secondary mt-1">Discard</a>
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
